import requests
import os
os.environ["HTTP_PROXY"]='http://music:AP-test@proxy.cc.utsunomiya-u.ac.jp:8080'
os.environ["HTTPS_PROXY"]='http://music:AP-test@proxy.cc.utsunomiya-u.ac.jp:8080'

"""
proxies={
    'http': 'http://music:AP-test@proxy.cc.utsunomiya-u.ac.jp:8080',
    'https': 'http://music:AP-test@proxy.cc.utsunomiya-u.ac.jp:8080',
}
"""

r=requests.get("https://news.yahoo.co.jp/")
print(r.text.encode('cp932','replace'))