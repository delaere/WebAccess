#!/bin/env python
from subprocess import check_output
import re
import json
import cgi

parameters = cgi.FieldStorage()
if parameters.has_key("server"):
	server = parameters["server"].value
else:
	#server = "127.0.0.1"
	server = "ingrid-ui1.cism.ucl.ac.be"
ret = check_output(["nmap", server,"-Pn","-p ssh"])
hotsUp = re.search("Host is up",ret)
result = re.search("22/tcp\s*(\w*)\s*ssh",ret)
responseTime = re.search("scanned in (.*$)",ret)
if hotsUp is None:
	outcome = {"result": "down", "responseTime":"N/A",  "fullresponse": ret}
else:
	outcome = {"result":result.group(1) , "responseTime":responseTime.group(1), "fullresponse": ret}

print "Content-Type: application/json"
print
print json.dumps(outcome)

