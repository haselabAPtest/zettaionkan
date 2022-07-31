import json
import matplotlib.pylab as plt


#グラフの作成 
json_open=open(r"C:\Users\music\Documents\xampp\zettaionkan\public\answer_test.json","r",encoding="utf-8")
json_load=json.load(json_open)

model={
    'p_C4':0,'p_C#4':1,'p_D4':2,'p_D#4':3,'p_E4':4,'p_F4':5,'p_F#4':6,'p_G4':7,'p_G#4':8,'p_A4':9,'p_A#4':10,'p_B4':11,
    'p_C5':12,'p_C#5':13,'p_D5':14,'p_D#5':15,'p_E5':16,'p_F5':17,'p_F#5':18,'p_G5':19,'p_G#5':20,'p_A5':21,'p_A#5':22,'p_B5':23,
    'p_C6':24,'p_C#6':25,'p_D6':26,'p_D#6':27,'p_E6':28,'p_F6':29,'p_F#6':30,'p_G6':31,'p_G#6':32,'p_A6':33,'p_A#6':34,'p_B6':35,
}

myList=json_load.items()
x,y=zip(*myList)

modelList=model.items()
mx,my=zip(*modelList)

plt.rcParams['figure.subplot.bottom'] = 0.15
plt.xticks(rotation=90,fontsize=7)
plt.yticks([0,12,24],['C4','C5','C6'])
plt.xlabel("問題",fontname="MS Gothic")
plt.ylabel("回答",fontname="MS Gothic")
plt.scatter(x,y,s=25,label='あなたの回答')
plt.plot(mx,my,color='red',label='正答例')
plt.title('ピアノ音',fontname='MS Gothic')
#plt.savefig('Fig1.png')
plt.legend(prop={"family":"MS Gothic"})
plt.show()
