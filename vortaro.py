from flask import Flask, send_from_directory, request, make_response, jsonify, url_for, redirect
import subprocess, os, sys, shutil

app = Flask(__name__)
#app.config['SERVER_NAME'] = 'vortaro.esperanto.or.kr:5005'

#@app.route('/index.html')
#def serve_index():
#    return redirect('/ekma')

@app.route('/')
def serve_root():
    # return redirect('/ekma/index.html')
    response = make_response(send_from_directory('./', 'index.html'))
    # response.headers['Cache-Control'] = 'max-age=3600'
    return response

@app.route('/ex', defaults={'path': 'index.html'})
@app.route('/ex/', defaults={'path': 'index.html'})
@app.route('/ex/<path:path>')
def serve_ex(path):
#    if path == '' or path == None: path = 'index.html'
    response = make_response(send_from_directory('./ex', path))
    # response.headers['Cache-Control'] = 'max-age=3600'
    return response

@app.route('/th', defaults={'path': 'index.html'})
@app.route('/th/', defaults={'path': 'index.html'})
@app.route('/th/<path:path>')
def serve_th(path):
#    if path == '' or path == None: path = 'index.html'
    response = make_response(send_from_directory('./th', path))
    # response.headers['Cache-Control'] = 'max-age=3600'
    return response

@app.route('/tw', defaults={'path': 'index.html'})
@app.route('/tw/', defaults={'path': 'index.html'})
@app.route('/tw/<path:path>')
def serve_tw(path):
#    if path == '' or path == None: path = 'index.html'
    response = make_response(send_from_directory('./tw', path))
    # response.headers['Cache-Control'] = 'max-age=3600'
    return response


@app.route('/b', defaults={'path': 'index.html'})
@app.route('/b/', defaults={'path': 'index.html'})
@app.route('/b/<path:path>')
def serve_b(path):
#    if path == '' or path == None: path = 'index.html'
    response = make_response(send_from_directory('./b', path))
    # response.headers['Cache-Control'] = 'max-age=3600'
    return response


@app.route('/ekma', defaults={'path': 'index.html'})
@app.route('/ekma/', defaults={'path': 'index.html'})
@app.route('/ekma/<path:path>')
def serve_ekma(path):
    print(path)
#    if path == '' or path == None or path == '/': path = 'index.html'
#    elif path[0] == '/': path = path[1:]
    response = make_response(send_from_directory('./ekma', path))
    # response.headers['Cache-Control'] = 'max-age=3600'
    return response


# favicon.ico 파일 서비스
@app.route('/favicon.ico')
def serve_favicon():
    return send_from_directory('.', 'favicon.ico')

@app.route('/api/sendmail.api', methods=['POST'])
def sendmail():
    who = request.json['who']
    text = request.json['text']

    fp = open("./sendmail.txt", "w")
    fp.write("SUBJECT: 사전 수정요청, " + who)       
    fp.write("\n" + text +"\n")
    fp.close()

    cmd = ["python3", "sendmail.py", "memlingo.service@gmail.com", "sendmail.txt", "sendmail.html"]
    output = subprocess.run(cmd, stdout=subprocess.PIPE)

    result = {'ok': 'yes', "msg": "발송되었습니다."}
    resp = make_response(jsonify(result))
    return resp

def read_conf():
    svc = {}
    fp = open("svc.conf", "r")
    for line in fp:
        if line[0] == "#":
            continue
        row = line.strip().split("=")
        if len(row) != 2:
            continue
        svc[row[0].strip()] = row[1].strip()
    fp.close()
    return svc

svc_conf = read_conf()

app.run(debug=True, host=svc_conf["IP"], port=int(svc_conf["PORT"]))
#IP=192.168.117.129
#PORT=5002

# app.run(debug=True, host='192.168.117.129', port=5005)
