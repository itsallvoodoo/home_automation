#!/usr/bin/env python2.7

#Server Connection to MySQL:

import MySQLdb

def fetch():
	w1="/sys/bus/w1/devices/10-000800444018/w1_slave"
	raw = open(w1, "r").read()
	return int(raw.split("t=")[-1])


if __name__ == '__main__':

	conn = MySQLdb.connect(host= "localhost",
	                  user="tempsensor",
	                  passwd="sensorpassword",
	                  db="homedb")
	x = conn.cursor()

	currentTemp = ((fetch())/1000.0*1.8+32.0)

	try:
	   x.execute("""INSERT INTO tempdata (tempEntry) VALUES (%s)""",(currentTemp))
	   conn.commit()
	except:
	   conn.rollback()

	conn.close()

