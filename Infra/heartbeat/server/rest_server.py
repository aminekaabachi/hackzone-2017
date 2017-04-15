#!flask/bin/python
import re
from flask import Flask, jsonify, abort, request, make_response, url_for, Response
import random
import string
import json

flag='W3_l0ve_Infra_learn_Docker'
app = Flask(__name__, static_url_path="")

url = '/tunizjan'

@app.errorhandler(400)
def not_found(error):
    return make_response(jsonify({'error': 'Bad request'}), 400)


@app.errorhandler(404)
def not_found(error):
    return make_response(jsonify({'error': 'Not found'}), 404)

@app.route('{0}/e1te/'.format(url), methods=['GET'])
def docker_file():
    with open('files/Dockerfile') as f:
        data=f.read()
    return data

@app.route('{0}/c21e/'.format(url), methods=['GET'])
def create_id():
    id = ''.join(random.SystemRandom().choice(string.ascii_uppercase + string.digits) for _ in range(16))
    open('files/%s'%id,'w+')
    with open('files/script.sh') as f:
        script=f.read()
    script = script%id
    return script

@app.route('{0}/zre/<string:address>'.format(url), methods=['GET'])
def get_hosts(address):
    hosts = read_hosts(address)
    if (hosts):
        return jsonify({'address': address,
		'hosts' : hosts,
		'status':'True'}), 200
    else:
        return jsonify({'address': address,
		'msg' : 'No active machines',
                'status':'False'}), 400



@app.route('{0}/s31d'.format(url), methods=['POST'])
def send_host():
    data= request.get_json(force=True) 
    if not ('ipaddr' in data and 'serverid' in data):
        abort(400)
    result = api_add(data['ipaddr'],data['serverid'])
    if result:
   	 return jsonify({'success': True}), 200
    else:
   	 return jsonify({'success': False}), 202


def api_add(ipaddr,address):
    try:
        json_data=open('files/%s'%address).read()
    except:
        return None
    if len(json_data)==0:
	data={'hosts':[]}
    else:
        data = json.loads(json_data)
    if ipaddr not in data['hosts']:
        data['hosts'].append(ipaddr)
        with open('files/%s'%address,'w') as f:
            f.write(json.dumps(data))

    return data
def read_hosts(address):
    try:
        json_data=open('files/%s'%address).read()
    except:
        return None
    if len(json_data)==0:
        data={'hosts':[]}
    else:
        data = json.loads(json_data)
    if len(data['hosts'])>64:
	data['msg']='Nice Job, this is your flag %s'%flag
    return data


if __name__ == '__main__':
    app.run(debug=True,host='0.0.0.0',port=81)
