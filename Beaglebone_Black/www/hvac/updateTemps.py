#Server Connection to MySQL:

import MySQLdb
import get_temp
conn = MySQLdb.connect(host= "localhost",
                  user="tempsensor",
                  passwd="sensorpassword",
                  db="homedb")
x = conn.cursor()

currentTemp = get_temp.fetch()

try:
   x.execute("""INSERT INTO tempdata (tempEntry) VALUES (%s)""",(currentTemp))
   conn.commit()
except:
   conn.rollback()

conn.close()
