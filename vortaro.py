from flask import Flask, send_from_directory, request, make_response, jsonify
import subprocess, os, sys, shutil

app = Flask(__name__)

@app.route('/ex/<path:path>')
def serve_ex(path):
    return send_from_directory('./ex', path)

app.run(debug=True, host='192.168.117.129', port=5005)


