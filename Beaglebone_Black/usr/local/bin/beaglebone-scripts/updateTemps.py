#Server Connection to MySQL:

import MySQLdb
import get_temp
conn = MySQLdb.connect(host= "localhost",
                  user="tempsensor",
                  passwd="sensorpassword",
                  db="homedb")
x = conn.cursor()

currentTemp = ((get_temp.fetch())/1000*1.8+32)

try:
   x.execute("""INSERT INTO tempdata (tempEntry) VALUES (%s)""",(currentTemp))
   conn.commit()
except:
   conn.rollback()

conn.close()
