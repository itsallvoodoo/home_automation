#!/usr/bin/env python2.7

# name:     updateTemps.py
# author:   Chad Hobbs
# created:  140122
# last edit: 140217
#
# description: This script fetches the current temperature from a Dallas DS1820 Temperature Sensor attached to the Beaglebone
#	and inserts it into a databse on the same micro-controller


# -------------LIBRARIES----------------
import MySQLdb

# ----------------------------------------------------------------------------------------
# Function Name: fetch()
# Parameters:    None
# Returns:       An integer from the DS1820
# Description:   This method accesses the temp sensor hardware and retrieves the temperature value from it
# ----------------------------------------------------------------------------------------
def fetch():

	w1="/sys/bus/w1/devices/10-000800444018/w1_slave"
	raw = open(w1, "r").read()
	return int(raw.split("t=")[-1])



# ----------------------------------------------------------------------------------------
# Function Name: main()
# Parameters:    None
# Returns:       None
# Description:   This is the main method
# ----------------------------------------------------------------------------------------
if __name__ == '__main__':


	# MySQLdb object parameters, via library, and connect
	conn = MySQLdb.connect(host= "localhost",
	                  user="tempsensor",
	                  passwd="sensorpassword",
	                  db="homedb")
	x = conn.cursor()

	# Call fetch method, convert, and store
	currentTemp = (fetch()/1000.0*1.8+32.0)

	# Insert into database
	try:
	   x.execute("""INSERT INTO tempdata (tempEntry) VALUES (%s)""",(currentTemp))
	   conn.commit()
	except:
	   conn.rollback()

	# Close database connection
	conn.close()

