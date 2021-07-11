#!/usr/bin/env python
from time import sleep
import RPi.GPIO as GPIO
from mfrc522 import SimpleMFRC522
import mysql.connector

DIR     =11
STEP    =13
DIR1    =15
STEP1   =16
CB2     =12
CB1     =7

#KHAI BAO CAC CHAN IN-OUT
GPIO.setwarnings(False)
GPIO.setmode(GPIO.BOARD)   # Use physical pin numbering
# GPIO.setup(31, GPIO.OUT, initial=GPIO.LOW)   #R
GPIO.setup(CB2, GPIO.IN)
GPIO.setup(CB1, GPIO.IN)
GPIO.setup(DIR, GPIO.OUT)   #DIR
GPIO.setup(STEP, GPIO.OUT)   #STEP
GPIO.setup(DIR1, GPIO.OUT)   #DIR1
GPIO.setup(STEP1, GPIO.OUT)   #STEP1

#GPIO.setup(18, GPIO.OUT, initial=GPIO.LOW)   #G
#GPIO.setup(22, GPIO.OUT, initial=GPIO.LOW)   #B
#KHAI BAO DATABASE
db = mysql.connector.connect(
  host="127.0.0.1",
  user="thuannguyen",
  passwd="2012",
  database="parking"
  )
cursor = db.cursor()
reader = SimpleMFRC522()

def motordonglen():
         GPIO.output(DIR1,GPIO.HIGH)  
         for i in range(0, 45):
                GPIO.output(STEP1,GPIO.HIGH)
                sleep(0.01)
                GPIO.output(STEP1,GPIO.LOW)
                sleep(0.01) 
                 
def motordongxuong():
         GPIO.output(DIR1,GPIO.LOW)  
         for i in range(0, 33):
                GPIO.output(STEP1,GPIO.HIGH)
                sleep(0.01)
                GPIO.output(STEP1,GPIO.LOW)
                sleep(0.01) 
                 
def motormolen():
         GPIO.output(DIR,GPIO.HIGH)  
         for i in range(0,40):
                 GPIO.output(STEP,GPIO.HIGH)
                 sleep(0.01)
                 GPIO.output(STEP,GPIO.LOW)
                 sleep(0.01) 
def motormoxuong():
         GPIO.output(DIR,GPIO.LOW)  
         for i in range(0,60):
                 GPIO.output(STEP,GPIO.HIGH)
                 sleep(0.01)
                 GPIO.output(STEP,GPIO.LOW)
                 sleep(0.01) 
       
try:
    while True:
   
        #QUET THE TRUOC
        print('Place Card to record attendance')
        id,text = reader.read()
        cursor.execute("update id set uid="+str(id)) 
        print(id)
      
            
        #-------------------------------------------------------------
        #TREN WEB BAM SUBMIT DE TAO DB MOI
        #DOC DATABASE
        cursor.execute("SELECT uid, name FROM rfid WHERE uid="+str(id))
        result = cursor.fetchone()
        db.commit()
       
        #KIEM TRA DATA
        if (cursor.rowcount >= 1) and not(GPIO.input(CB2)):  #ra
            print("Welcome " + result[1])
            motordonglen()
            sleep(3)
            motordongxuong()
            
        else:
            print("User does not exist.")
       
          
        if (cursor.rowcount >= 1) and not(GPIO.input(CB1)):#vao
            print("Welcome " + result[1])
            GPIO.output(DIR,GPIO.LOW)  
            for i in range(0,55):
                 GPIO.output(STEP,GPIO.HIGH)
                 sleep(0.01)
                 GPIO.output(STEP,GPIO.LOW)
                 sleep(0.01) 
            sleep(3)
            GPIO.output(DIR,GPIO.HIGH)  
            for i in range(0,55):
                 GPIO.output(STEP,GPIO.HIGH)
                 sleep(0.01)
                 GPIO.output(STEP,GPIO.LOW)
                 sleep(0.01) 
    
        else:
          print("User does not exist.")
          
        sleep(5)
finally:

  GPIO.cleanup()