import time

w1="/sys/bus/w1/devices/10-000800444018/w1_slave"

while True:
    raw = open(w1, "r").read()
    print "Temperature is "+str(float(raw.split("t=")[-1])/1000*1.8+32)+" degrees"
    time.sleep(1)
