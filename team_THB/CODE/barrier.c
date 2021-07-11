#include <stdio.h>
#include<wiringPi.h>
#include <stdlib.h>
#include <string.h>
#include <mysql.h>
signed int i,dk=0,dk1=0;
#define step 13
#define dir 11
#define step1 16 
#define dir1 15

    MYSQL *conn;
    MYSQL_RES *res;
    MYSQL_ROW row;

    char *server = "127.0.0.1";
    char *user ="thuannguyen";
    char *password = "2012"; /* set me first */
    char *database = "parking";


int main(void)
{
    

    // setup thu vien wiringPi
        wiringPiSetupPhys();

    // Khai bao IO, interrupt, softPWM
        pinMode(step,OUTPUT);
	    pinMode(dir,OUTPUT);
		pinMode(step1,OUTPUT);
	    pinMode(dir1,OUTPUT);
    
    while(1){
        // ket noi database
        conn = mysql_init(NULL);
        mysql_real_connect(conn,server,user,password,database,0,NULL,0); 
        // kiem tra cot isUpdated
        char sql[200];
        sprintf(sql, "select * from barrier");
        mysql_query(conn,sql);
        res = mysql_store_result(conn); 
        row = mysql_fetch_row(res); //row[0]-> red; row[1]->green
        // NOTES: row la bien dang chuoi ky tu
		if((atoi(row[0])==1)&& (dk==0)){
			printf("Nhan duoc tin hieu 1");
			digitalWrite(dir,LOW);
	        for (i=0;i<50;i++) 
			
			  {
				 digitalWrite(step,HIGH); 
				 delayMicroseconds(1000); 
				 digitalWrite(step,LOW); 
				 delayMicroseconds(1000); 
			  }
			  dk=1;
		}
		if((atoi(row[0])==0)&& (dk==1)){
			printf("Nhan duoc tin hieu 0");
			digitalWrite(dir,HIGH); 
            for(int i = 0; i<50; i++) 
	        {
				 digitalWrite(step,HIGH);
				 delayMicroseconds(1000);
				 digitalWrite(step,LOW);
				 delayMicroseconds(1000);
            }
			dk=0;
		}
		////////////////////////////////////////////////////////////////////////////
		if((atoi(row[1])==1)&& (dk1==0)){
			printf("Nhan duoc tin hieu 1");
			digitalWrite(dir1,HIGH);
	        for (i=0;i<50;i++) 
			
			  {
				 digitalWrite(step1,HIGH); 
				 delayMicroseconds(1000); 
				 digitalWrite(step1,LOW); 
				 delayMicroseconds(1000); 
			  }
			  dk1=1;
		}
		if((atoi(row[1])==0)&& (dk1==1)){
			printf("Nhan duoc tin hieu 0");
			digitalWrite(dir1,LOW); 
            for(int i = 0; i<50; i++) 
	        {
				 digitalWrite(step1,HIGH);
				 delayMicroseconds(1000);
				 digitalWrite(step1,LOW);
				 delayMicroseconds(1000);
            }
			dk1=0;
		}
		///////////////////////////////////////////////////////
		delay(600);
		mysql_close(conn);
    }
    return 0;
}