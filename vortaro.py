from flask import Flask, send_from_directory, request, make_response, jsonify, url_for
import subprocess, os, sys, shutil

app = Flask(__name__)

@app.route('/ex/<path:path>')
def serve_ex(path):
    response = make_response(send_from_directory('./ex', path))
    # response.headers['Cache-Control'] = 'max-age=3600'
    return response

app.run(debug=True, host='192.168.117.129', port=5005)