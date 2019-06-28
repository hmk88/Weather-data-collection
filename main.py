#Author :  Hafiz Haq <Hafiz.haq@uwasa.fi>


########################Main Program###############################

import serial
import time
import ablib
import MySQLdb
import datetime
#Initializing and configuring port 

Power_USB_A = ablib.Pin('N','7','high')
#Power_USB_B = ablib.Pin('N','8','high')
Power_USB_C = ablib.Pin('N','9','high')

Power_USB_A.on()
time.sleep(1) 
#Power_USB_B.on()
#time.sleep(1)
Power_USB_C.on()
time.sleep(1) 

#Power_USB_B.off()
Power_USB_C.off()

##################################

#Start
	
while 1:
	
		print "USB A ON"
		Power_USB_A.on()
		time.sleep(5)
		usb = serial.Serial()
		usb.port = "/dev/ttyUSB0"
		usb.baudrate = 19200
		usb.bytesize = serial.EIGHTBITS
		usb.parity = serial.PARITY_NONE
		usb.stopbits = serial.STOPBITS_ONE
		usb.timeout = 1
		time.sleep(2)
		usb.open()
		time.sleep(5) 
		out = usb.readline()
		time.sleep(1)
		print ">>" + out
		time.sleep(1)
		s=out.split(',',8)
		usb.close()
		time.sleep(1)
		
		#Connecting to the database
		db=MySQLdb.connect(host="127.0.0.1",port=3306,db="mydb",user="root",passwd="ariag25")
		cur = db.cursor()
		cur.execute("SELECT * FROM data11;")
		
		#wind direction
		Dm= [s[1].split('=',2)[1]]
		Dm=', '.join(Dm)
		#wind speed
		Sm=[s[2].split('=',2)[1]]
		Sm=', '.join(Sm)
		#air temperature
		Ta=[s[3].split('=',2)[1]]
		Ta=', '.join(Ta)
		#relative humidity
		Ua=[s[4].split('=',2)[1]]
		Ua=', '.join(Ua)
		#air pressure
		Pa=[s[5].split('=',2)[1]]
		Pa=', '.join(Pa)
		#rain accumulator
		Rc=[s[6].split('=',2)[1]]
		Rc=', '.join(Rc)
		#heating temperature
		Th=[s[7].split('=',2)[1]]
		Th=', '.join(Th)
		#heating voltage
		Vh=[s[8].split('=',2)[1]]
		Vh=', '.join(Vh)
		now=datetime.datetime.now()
		d=now.strftime("%d.%m.%y")
		t=now.strftime("%H:%M")

		cur.execute('INSERT INTO data11 (Wind_direction, Wind_speed, Temperature, Humidity, Pressure, Rain_accumulator, 		Heating_temperature, Heating_voltage, Date, Time) VALUES ("%s","%s","%s","%s","%s","%s","%s","%s", "%s", "%s")' %(Dm,Sm,Ta,Pa,Ua,Rc,Th,Vh,d,t)) 

		try:
			# Execute the SQL command
			#cur.execute(sql)
			# Commit your changes in the database
   			db.commit()
			print "Successfully saved the data into database"
			time.sleep(2)
		except:
			# Rollback in case there is any error
			db.rollback()
			print "Error in entering data"

		db.close()
		Power_USB_A.off()	
		print "USB A Off"
		print "Next reading after 10 minutes"
		#This is the time for the next cycle 
		time.sleep(600) 
			

#End
