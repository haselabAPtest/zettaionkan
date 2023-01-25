import json
import matplotlib.pylab as plt
import pickle
import os.path
from googleapiclient.discovery import build
from google_auth_oauthlib.flow import InstalledAppFlow
from google.auth.transport.requests import Request
import base64
from email.mime.text import MIMEText
from email.mime.image import MIMEImage
from email.utils import formatdate
from email.mime.multipart import MIMEMultipart
from apiclient import errors
import logging
import os

from numpy import unicode_

#GmailAPIを使用する際のプロキシ通し
os.environ["HTTP_PROXY"]='http://music:AP-test@proxy.cc.utsunomiya-u.ac.jp:8080'
os.environ["HTTPS_PROXY"]='http://music:AP-test@proxy.cc.utsunomiya-u.ac.jp:8080'

logger = logging.getLogger(__name__)

#ファイルパス設定
PATH=r"C:\Users\music\Documents\xampp\zettaionkan\\app\Python\\"

#Gmail APIのスコープ設定
SCOPES = [
    "https://www.googleapis.com/auth/gmail.compose",
    "https://www.googleapis.com/auth/gmail.readonly",
    "https://www.googleapis.com/auth/gmail.labels",
    "https://www.googleapis.com/auth/gmail.modify",
    "https://www.googleapis.com/auth/gmail.send",
]
CLIENT_SECRETS_FILE=PATH+'client_secrets.json'

#jsonファイル読み込み
#メールアドレス
json_open=open(PATH+'mail_test.json','r',encoding='utf-8')
address_load=json.load(json_open)
#回答
json_open=open(PATH+'answer_test.json','r',encoding='utf-8')
json_load=json.load(json_open)

#グラフ作成
model={
    'p_C4':0,'p_C#4':1,'p_D4':2,'p_D#4':3,'p_E4':4,'p_F4':5,'p_F#4':6,'p_G4':7,'p_G#4':8,'p_A4':9,'p_A#4':10,'p_B4':11,
    'p_C5':12,'p_C#5':13,'p_D5':14,'p_D#5':15,'p_E5':16,'p_F5':17,'p_F#5':18,'p_G5':19,'p_G#5':20,'p_A5':21,'p_A#5':22,'p_B5':23,
    'p_C6':24,'p_C#6':25,'p_D6':26,'p_D#6':27,'p_E6':28,'p_F6':29,'p_F#6':30,'p_G6':31,'p_G#6':32,'p_A6':33,'p_A#6':34,'p_B6':35,
}

myList=json_load.items()
x,y=zip(*myList)

modelList=model.items()
mx,my=zip(*modelList)

plt.rcParams['font.family']='MS Gothic'
#回答グラフ
fig=plt.figure()
plt.rcParams['figure.subplot.bottom'] = 0.15
plt.xticks(rotation=90,fontsize=7)
plt.yticks([0,12,24],['C4','C5','C6'])
plt.xlabel('問題')
plt.ylabel('回答')
plt.plot(mx,my,color='black',label='正答例')
for k,v in myList:
    if model[k]==v:
        plt.scatter(k,v,s=25,color='blue')
    elif v==999:
        continue
    else:
        plt.scatter(k,v,s=25,color='red')
plt.scatter([],[],color='blue',label='正答')
plt.scatter([],[],color='red',label='誤答')
plt.title('ピアノ音')
fig.savefig(PATH+'Fig1.png',dpi=100)

#オクターブエラーなど
bar=plt.figure()
OE=0        #オクターブエラー
flat=0      #半音下
sharp=0     #半音上
unclear=0   #不明

for k,v in myList:
    if model[k]!=v:
        if v==model[k]-1:
            flat+=1
        elif v==model[k]+1:
            sharp+=1
        elif v==model[k]-12 or v==model[k]-24 or v==model[k]+12 or v==model[k]+24:
            OE+=1
        else:
            unclear+=1
E_label=['OE','半音下','半音上','判別不能']
E_data=[OE,flat,sharp,unclear]
plt.xlabel("誤答の種類")
plt.ylabel("誤答数")
plt.title('誤答分布')
plt.bar(E_label,E_data)
bar.savefig(PATH+'Fig2.png',dpi=100)
            
#plt.show()

#メール本文の作成
def create_message(sender,to,subject,message_text,cc=None):
    msg=MIMEMultipart()
    msg['from']=sender
    msg['to']=to
    msg['Subject']=subject
    msg['Date']=formatdate()
    msg.attach(MIMEText(message_text,'html'))
    
    with open(PATH+'Fig1.png','rb') as img:
        atchment_file1=MIMEImage(img.read(),_subtype='png')
    with open(PATH+'Fig2.png','rb') as img:
        atchment_file2=MIMEImage(img.read(),_subtype='png')
    
    atchment_file1.set_param('name','Fig1.png')
    atchment_file1.add_header('Content-ID','<Fig1_image>')
    msg.attach(atchment_file1)
    atchment_file2.set_param('name','Fig2.png')
    atchment_file2.add_header('Content-ID','<Fig2_image>')
    msg.attach(atchment_file2)
    
    byte_msg=msg.as_string().encode(encoding="UTF-8")
    byte_msg_b64encoded=base64.urlsafe_b64encode(byte_msg)
    str_msg_b64encoded=byte_msg_b64encoded.decode(encoding="UTF-8")
    return {"raw":str_msg_b64encoded}

#メール送信の実行
def send_message(service,user_id,message):
    try:
        sent_message=(service.users().messages().send(userId=user_id,body=message).execute())
        logger.info("Message Id: %s" % sent_message['id'])
        return None
    except errors.HttpError as error:
        logger.info('An error occurred: $s' % error)
        return error

#htmlテンプレートの読み込み        
def read_text(file_path):
    s=''
    with open(file_path,encoding='utf-8') as f:
        s=f.read()
    return s

#メイン処理
def main():
    #アクセストークン取得
    creds=None
    
    if os.path.exists('token.pickle'):
        with open('token.pickle','rb') as token:
            creds=pickle.load(token)
            
    if not creds or not creds.valid:
        if creds and creds.expired and creds.refresh_token:
            creds.refresh(Request())
        else:
            flow=InstalledAppFlow.from_client_secrets_file(CLIENT_SECRETS_FILE,SCOPES)
            creds=flow.run_local_server()
            
        with open('token.pickle','wb') as token:
            pickle.dump(creds,token)
            
    service=build('gmail','v1',credentials=creds,static_discovery=False,cache_discovery=False)
            
    #メール本文作成
    sender='aisawa.y@sound.is.utsunomiya-u.ac.jp '
    to=address_load
    subject='メール自動送信テスト'
    message_text=read_text(PATH+'mail_format.html')
    
    message=create_message(sender,to,subject,message_text)
    
    #Gmail APIを呼び出してメール送信
    send_message(service,'me',message)
    
    #作成した画像を削除
    #os.remove(PATH+'Fig1.png')
    
#プログラム実行
if __name__ == '__main__':
    main()
    