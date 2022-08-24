from email.mime.message import MIMEMessage
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
CLIENT_SECRETS_FILE=PATH+'client_secrets.json'

#Gmail APIのスコープ設定
SCOPES = [
    'https://www.googleapis.com/auth/gmail.compose',
    'https://www.googleapis.com/auth/gmail.readonly',
    'https://www.googleapis.com/auth/gmail.labels',
    'https://www.googleapis.com/auth/gmail.modify',
    'https://www.googleapis.com/auth/gmail.send',
]


#グラフ作成関数
def createGraph():
    #正答例モデル作成
    model={
        'C4':0,'C#4':1,'D4':2,'D#4':3,'E4':4,'F4':5,'F#4':6,'G4':7,'G#4':8,'A4':9,'A#4':10,'B4':11,
        'C5':12,'C#5':13,'D5':14,'D#5':15,'E5':16,'F5':17,'F#5':18,'G5':19,'G#5':20,'A5':21,'A#5':22,'B5':23,
        'C6':24,'C#6':25,'D6':26,'D#6':27,'E6':28,'F6':29,'F#6':30,'G6':31,'G#6':32,'A6':33,'A#6':34,'B6':35,
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
    userInfo=[name,mail]
    
    ans_piano={
        'C4':result[3],'C4':result[4],'D4':result[5],'D#4':result[6],'E4':result[7],'F4':result[8],'F#4':result[9],'G4':result[10],'G#4':result[11],'A4':result[12],'A#4':result[13],'B4':result[14],
        'C5':result[15],'C#5':result[16],'D5':result[17],'D#5':result[18],'E5':result[19],'F5':result[20],'F#5':result[21],'G5':result[22],'G#5':result[23],'A5':result[24],'A#5':result[25],'B5':result[26],
        'C6':result[27],'C#6':result[28],'D6':result[29],'D#6':result[30],'E6':result[31],'F6':result[32],'F#6':result[33],'G6':result[34],'G#6':result[35],'A6':result[36],'A#6':result[37],'B6':result[38],
    }
    ans_guitar={
        'C4':result[39],'C#4':result[40],'D4':result[41],'D#4':result[42],'E4':result[43],'F4':result[44],'F#4':result[45],'G4':result[46],'G#4':result[47],'A4':result[48],'A#4':result[49],'B4':result[50],
        'C5':result[51],'C#5':result[52],'D5':result[53],'D#5':result[54],'E5':result[55],'F5':result[56],'F#5':result[57],'G5':result[58],'G#5':result[59],'A5':result[60],'A#5':result[61],'B5':result[62],
        'C6':result[63],'C#6':result[64],'D6':result[65],'D#6':result[66],'E6':result[67],'F6':result[68],'F#6':result[69],'G6':result[70],'G#6':result[71],'A6':result[72],'A#6':result[73],'B6':result[74],
    }
    ans_pure={
        'C4':result[75],'C#4':result[76],'D4':result[77],'D#4':result[78],'E4':result[79],'F4':result[80],'F#4':result[81],'G4':result[82],'G#4':result[83],'A4':result[84],'A#4':result[85],'B4':result[86],
        'C5':result[87],'C#5':result[88],'D5':result[89],'D#5':result[90],'E5':result[91],'F5':result[92],'F#5':result[93],'G5':result[94],'G#5':result[95],'A5':result[96],'A#5':result[97],'B5':result[98],
        'C6':result[99],'C#6':result[100],'D6':result[101],'D#6':result[102],'E6':result[103],'F6':result[104],'F#6':result[105],'G6':result[106],'G#6':result[107],'A6':result[108],'A#6':result[109],'B6':result[110],
    }

    p_myList=ans_piano.items()
    g_myList=ans_guitar.items()
    s_myList=ans_pure.items()

    modelList=model.items()
    mx,my=zip(*modelList)

    plt.rcParams['font.family']='MS Gothic'
    #回答グラフ作成
    #piano
    fig=plt.figure()
    plt.rcParams['figure.subplot.bottom'] = 0.15
    plt.xticks(rotation=90,fontsize=7)
    plt.yticks([0,12,24],['C4','C5','C6'])
    plt.xlabel('問題')
    plt.ylabel('回答')
    plt.plot(mx,my,color='black',label='正答例')
    for k,v in p_myList:
        if model[k]==v:
            plt.scatter(k,v,s=25,color='blue')
        elif v==999:
            continue
        else:
            plt.scatter(k,v,s=25,color='red')
    plt.scatter([],[],color='blue',label='正答')
    plt.scatter([],[],color='red',label='誤答')
    plt.title('ピアノ音')
    fig.savefig(PATH+'p_Fig1.png',dpi=100)
    
    #guitar
    fig=plt.figure()
    plt.rcParams['figure.subplot.bottom'] = 0.15
    plt.xticks(rotation=90,fontsize=7)
    plt.yticks([0,12,24],['C4','C5','C6'])
    plt.xlabel('問題')
    plt.ylabel('回答')
    plt.plot(mx,my,color='black',label='正答例')
    for k,v in g_myList:
        if model[k]==v:
            plt.scatter(k,v,s=25,color='blue')
        elif v==999:
            continue
        else:
            plt.scatter(k,v,s=25,color='red')
    plt.scatter([],[],color='blue',label='正答')
    plt.scatter([],[],color='red',label='誤答')
    plt.title('ギター音')
    fig.savefig(PATH+'g_Fig1.png',dpi=100)
    
    #guitar
    fig=plt.figure()
    plt.rcParams['figure.subplot.bottom'] = 0.15
    plt.xticks(rotation=90,fontsize=7)
    plt.yticks([0,12,24],['C4','C5','C6'])
    plt.xlabel('問題')
    plt.ylabel('回答')
    plt.plot(mx,my,color='black',label='正答例')
    for k,v in s_myList:
        if model[k]==v:
            plt.scatter(k,v,s=25,color='blue')
        elif v==999:
            continue
        else:
            plt.scatter(k,v,s=25,color='red')
    plt.scatter([],[],color='blue',label='正答')
    plt.scatter([],[],color='red',label='誤答')
    plt.title('純音')
    fig.savefig(PATH+'s_Fig1.png',dpi=100)

    #オクターブエラーなどの画像作成
    #piano
    bar=plt.figure()
    OE=0        #オクターブエラー
    flat=0      #半音下
    sharp=0     #半音上
    unclear=0   #不明

    for k,v in p_myList:
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
    bar.savefig(PATH+'p_Fig2.png',dpi=100)
    
    #guitar
    bar=plt.figure()
    OE=0        #オクターブエラー
    flat=0      #半音下
    sharp=0     #半音上
    unclear=0   #不明

    for k,v in g_myList:
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
    bar.savefig(PATH+'g_Fig2.png',dpi=100)
    
    #pure
    bar=plt.figure()
    OE=0        #オクターブエラー
    flat=0      #半音下
    sharp=0     #半音上
    unclear=0   #不明

    for k,v in s_myList:
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
    bar.savefig(PATH+'s_Fig2.png',dpi=100)
    
    return userInfo

#メール本文の作成
def create_message(sender,to,subject,message_text,cc=None):
    msg=MIMEMultipart()
    msg['from']=sender
    msg['to']=to
    msg['Subject']=subject
    msg['Date']=formatdate()
    msg.attach(MIMEText(message_text,'html'))
    
    #作成した画像をhtmlに紐づける
    with open(PATH+'p_Fig1.png','rb') as p_img1:
        p_atchment_file1=MIMEImage(p_img1.read(),_subtype='png')
    
    p_atchment_file1.set_param('name','p_Fig1.png')
    p_atchment_file1.add_header('Content-ID','<p_Fig1_image>')
    msg.attach(p_atchment_file1)
    
    with open(PATH+'p_Fig2.png','rb') as p_img2:
        p_atchment_file2=MIMEImage(p_img2.read(),_subtype='png')
    
    p_atchment_file2.set_param('name','p_Fig2.png')
    p_atchment_file2.add_header('Content-ID','<p_Fig2_image>')
    msg.attach(p_atchment_file2)
    
    with open(PATH+'g_Fig1.png','rb') as g_img1:
        g_atchment_file1=MIMEImage(g_img1.read(),_subtype='png')
        
    g_atchment_file1.set_param('name','g_Fig1.png')
    g_atchment_file1.add_header('Content-ID','<g_Fig1_image>')
    msg.attach(g_atchment_file1)
    
    with open(PATH+'g_Fig2.png','rb') as g_img2:
        g_atchment_file2=MIMEImage(g_img2.read(),_subtype='png')
    
    g_atchment_file2.set_param('name','g_Fig2.png')
    g_atchment_file2.add_header('Content-ID','<g_Fig2_image>')
    msg.attach(g_atchment_file2)
    
    with open(PATH+'s_Fig1.png','rb') as s_img1:
        s_atchment_file1=MIMEImage(s_img1.read(),_subtype='png')
        
    s_atchment_file1.set_param('name','s_Fig1.png')
    s_atchment_file1.add_header('Content-ID','<s_Fig1_image>')
    msg.attach(s_atchment_file1)
    
    with open(PATH+'s_Fig2.png','rb') as s_img2:
        s_atchment_file2=MIMEImage(s_img2.read(),_subtype='png')
    
    s_atchment_file2.set_param('name','s_Fig2.png')
    s_atchment_file2.add_header('Content-ID','<s_Fig2_image>')
    msg.attach(s_atchment_file2)
    
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
    userInfo=createGraph()
    username=userInfo[0]
    mail=userInfo[1]
    
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
    subject='絶対音感テストの結果_'+username+"様"
    message_text=read_text(PATH+'mail_format.html')
    
    message=create_message(sender,to,subject,message_text)
    
    #Gmail APIを呼び出してメール送信
    send_message(service,'me',message)
    
#プログラム実行
if __name__ == '__main__':
    main()
    