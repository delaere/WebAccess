#!/bin/env python

import MySQLdb
import json


try:
	cnx = MySQLdb.connect(user='llbb', passwd='ih[DAMAS]-bbll',
       		              host='cp3.irmp.ucl.ac.be',
                              db='llbb',
			      connect_timeout=30)

except MySQLdb.Error, e:
		outcome = { "result":"bad" , "error":e.args }
else:	
	c=cnx.cursor()
	c.execute("""SELECT userName from users where role = "ADMIN" """)
	if c.fetchone()[0]=="adminUser":
		outcome = { "result":"good" , "error":[] }
	else:
		outcome = { "result":"bad" , "error":[-1,"The expected ADMIN user is absent"] }
	cnx.close()
print "Content-Type: application/json"
print
print json.dumps(outcome)
