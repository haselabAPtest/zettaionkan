import json
from tkinter import W
from turtle import home
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
import time
import mysql
import mysql.connector
import pymysql.cursors
import pymysql


logger = logging.getLogger(__name__)

#環境変数
#ファイルパス設定
PATH=r'D:\xampp\htdocs\piano_demo\app\Python\\'
ADDRESS='nasu.y@sound.is.utsunomiya-u.ac.jp'
HOST='127.0.0.1'
PORT=3306
USER='testuser'
PASSWORD='pw4testuser'
DATABASE='test'

#Gmail APIのスコープ設定
SCOPES = [
    'https://www.googleapis.com/auth/gmail.compose',
    'https://www.googleapis.com/auth/gmail.readonly',
    'https://www.googleapis.com/auth/gmail.labels',
    'https://www.googleapis.com/auth/gmail.modify',
    'https://www.googleapis.com/auth/gmail.send',
]
CLIENT_SECRETS_FILE=PATH+'client_secrets.json'


connection = pymysql.connect(host=HOST, port=PORT, user=USER, password=PASSWORD, db=DATABASE,charset='utf8')

try:
    with connection.cursor() as cursor:
        sql = "SELECT * FROM send_mail ORDER BY id DESC LIMIT 1"
        cursor.execute(sql)
        result=cursor.fetchone()
        connection.commit()
finally:
    connection.close()

name=result[1]
mail=result[2]
ans_piano={
    'p_C4':result[3],'p_C#4':result[4],'p_D4':result[5],'p_D#4':result[6],'p_E4':result[7],'p_F4':result[8],'p_F#4':result[9],'p_G4':result[10],'p_G#4':result[11],'p_A4':result[12],'p_A#4':result[13],'p_B4':result[14],
    'p_C5':result[15],'p_C#5':result[16],'p_D5':result[17],'p_D#5':result[18],'p_E5':result[19],'p_F5':result[20],'p_F#5':result[21],'p_G5':result[22],'p_G#5':result[23],'p_A5':result[24],'p_A#5':result[25],'p_B5':result[26],
    'p_C6':result[27],'p_C#6':result[28],'p_D6':result[29],'p_D#6':result[30],'p_E6':result[31],'p_F6':result[32],'p_F#6':result[33],'p_G6':result[34],'p_G#6':result[35],'p_A6':result[36],'p_A#6':result[37],'p_B6':result[38],
}
ans_guitar={
    'g_C4':result[39],'g_C#4':result[40],'g_D4':result[41],'g_D#4':result[42],'g_E4':result[43],'g_F4':result[44],'g_F#4':result[45],'g_G4':result[46],'g_G#4':result[47],'g_A4':result[48],'g_A#4':result[49],'g_B4':result[50],
    'g_C5':result[51],'g_C#5':result[52],'g_D5':result[53],'g_D#5':result[54],'g_E5':result[55],'g_F5':result[56],'g_F#5':result[57],'g_G5':result[58],'g_G#5':result[59],'g_A5':result[60],'g_A#5':result[61],'g_B5':result[62],
    'g_C6':result[63],'g_C#6':result[64],'g_D6':result[65],'g_D#6':result[66],'g_E6':result[67],'g_F6':result[68],'g_F#6':result[69],'g_G6':result[70],'g_G#6':result[71],'g_A6':result[72],'g_A#6':result[73],'g_B6':result[74],
}
ans_pure={
    's_C4':result[75],'s_C#4':result[76],'s_D4':result[77],'s_D#4':result[78],'s_E4':result[79],'s_F4':result[80],'s_F#4':result[81],'s_G4':result[82],'s_G#4':result[83],'s_A4':result[84],'s_A#4':result[85],'s_B4':result[86],
    's_C5':result[87],'s_C#5':result[88],'s_D5':result[89],'s_D#5':result[90],'s_E5':result[91],'s_F5':result[92],'s_F#5':result[93],'s_G5':result[94],'s_G#5':result[95],'s_A5':result[96],'s_A#5':result[97],'s_B5':result[98],
    's_C6':result[99],'s_C#6':result[100],'s_D6':result[101],'s_D#6':result[102],'s_E6':result[103],'s_F6':result[104],'s_F#6':result[105],'s_G6':result[106],'s_G#6':result[107],'s_A6':result[108],'s_A#6':result[109],'s_B6':result[110],
}



#グラフ作成関数
def createGraph():
    #正答例モデル作成
    model={
        'p_C4':0,'p_C#4':1,'p_D4':2,'p_D#4':3,'p_E4':4,'p_F4':5,'p_F#4':6,'p_G4':7,'p_G#4':8,'p_A4':9,'p_A#4':10,'p_B4':11,
        'p_C5':12,'p_C#5':13,'p_D5':14,'p_D#5':15,'p_E5':16,'p_F5':17,'p_F#5':18,'p_G5':19,'p_G#5':20,'p_A5':21,'p_A#5':22,'p_B5':23,
        'p_C6':24,'p_C#6':25,'p_D6':26,'p_D#6':27,'p_E6':28,'p_F6':29,'p_F#6':30,'p_G6':31,'p_G#6':32,'p_A6':33,'p_A#6':34,'p_B6':35,
    }
    
    connection = pymysql.connect(host=HOST, port=PORT, user=USER, password=PASSWORD, db=DATABASE,charset='utf8')

    #データベースに接続
    try:
        with connection.cursor() as cursor:
            sql = "SELECT * FROM send_mail ORDER BY id DESC LIMIT 1"
            cursor.execute(sql)
            result=cursor.fetchone()
            connection.commit()
    finally:
        connection.close()

    name=result[1]
    mail=result[2]
    ans_piano={
        'p_C4':result[3],'p_C4':result[4],'p_D4':result[5],'p_D#4':result[6],'p_E4':result[7],'p_F4':result[8],'p_F#4':result[9],'p_G4':result[10],'p_G#4':result[11],'p_A4':result[12],'p_A#4':result[13],'p_B4':result[14],
        'p_C5':result[15],'p_C#5':result[16],'p_D5':result[17],'p_D#5':result[18],'p_E5':result[19],'p_F5':result[20],'p_F#5':result[21],'p_G5':result[22],'p_G#5':result[23],'p_A5':result[24],'p_A#5':result[25],'p_B5':result[26],
        'p_C6':result[27],'p_C#6':result[28],'p_D6':result[29],'p_D#6':result[30],'p_E6':result[31],'p_F6':result[32],'p_F#6':result[33],'p_G6':result[34],'p_G#6':result[35],'p_A6':result[36],'p_A#6':result[37],'p_B6':result[38],
    }
    ans_guitar={
        'g_C4':result[39],'g_C#4':result[40],'g_D4':result[41],'g_D#4':result[42],'g_E4':result[43],'g_F4':result[44],'g_F#4':result[45],'g_G4':result[46],'g_G#4':result[47],'g_A4':result[48],'g_A#4':result[49],'g_B4':result[50],
        'g_C5':result[51],'g_C#5':result[52],'g_D5':result[53],'g_D#5':result[54],'g_E5':result[55],'g_F5':result[56],'g_F#5':result[57],'g_G5':result[58],'g_G#5':result[59],'g_A5':result[60],'g_A#5':result[61],'g_B5':result[62],
        'g_C6':result[63],'g_C#6':result[64],'g_D6':result[65],'g_D#6':result[66],'g_E6':result[67],'g_F6':result[68],'g_F#6':result[69],'g_G6':result[70],'g_G#6':result[71],'g_A6':result[72],'g_A#6':result[73],'g_B6':result[74],
    }
    ans_pure={
        's_C4':result[75],'s_C#4':result[76],'s_D4':result[77],'s_D#4':result[78],'s_E4':result[79],'s_F4':result[80],'s_F#4':result[81],'s_G4':result[82],'s_G#4':result[83],'s_A4':result[84],'s_A#4':result[85],'s_B4':result[86],
        's_C5':result[87],'s_C#5':result[88],'s_D5':result[89],'s_D#5':result[90],'s_E5':result[91],'s_F5':result[92],'s_F#5':result[93],'s_G5':result[94],'s_G#5':result[95],'s_A5':result[96],'s_A#5':result[97],'s_B5':result[98],
        's_C6':result[99],'s_C#6':result[100],'s_D6':result[101],'s_D#6':result[102],'s_E6':result[103],'s_F6':result[104],'s_F#6':result[105],'s_G6':result[106],'s_G#6':result[107],'s_A6':result[108],'s_A#6':result[109],'s_B6':result[110],
    }

    myList=ans_piano.items()

    modelList=model.items()
    mx,my=zip(*modelList)
    print(result[3])

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
    plt.xlabel('誤答の種類')
    plt.ylabel('誤答数')
    plt.title('誤答分布')
    plt.bar(E_label,E_data)
    bar.savefig(PATH+'Fig2.png',dpi=100)
    
    return mail

#メール本文の作成
def create_message(sender,to,subject,message_text,cc=None):
    msg=MIMEMultipart()
    msg['from']=sender
    msg['to']=to
    msg['Subject']=subject
    msg['Date']=formatdate()
    msg.attach(MIMEText(message_text,'html'))
    
    with open(PATH+'Fig1.png','rb') as img:
        atchment_file=MIMEImage(img.read(),_subtype='png')
    
    atchment_file.set_param('name','Fig1.png')
    atchment_file.add_header('Content-ID','<Fig1_image>')
    msg.attach(atchment_file)
    
    byte_msg=msg.as_string().encode(encoding='UTF-8')
    byte_msg_b64encoded=base64.urlsafe_b64encode(byte_msg)
    str_msg_b64encoded=byte_msg_b64encoded.decode(encoding='UTF-8')
    return {'raw':str_msg_b64encoded}

#メール送信の実行
def send_message(service,user_id,message):
    try:
        sent_message=(service.users().messages().send(userId=user_id,body=message).execute())
        logger.info('Message Id: %s' % sent_message['id'])
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
    mail=createGraph()
    
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
    sender='nasu.y@sound.is.utsunomiya-u.ac.jp '
    to=mail
    subject='メール自動送信テスト'
    message_text=read_text(PATH+'mail_format.html')
    
    message=create_message(sender,to,subject,message_text)
    
    #Gmail APIを呼び出してメール送信
    send_message(service,'me',message)
    
#プログラム実行
if __name__ == '__main__':
    main()
    