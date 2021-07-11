#include <stdlib.h>
#include <stdio.h>
#include <mysql.h>
#include <time.h>
#include <wiringPi.h>

short int i,cb,stt,data=0,dk=0,dk1=0;

#define CB1 7 
#define CB2 12
#define CB3 33
#define CB4 35
#define CB5 37
#define CB6 36
#define CB7 38
#define CB8 40

#define step 	13
#define dir 	11
#define step1 	16 
#define dir1 	15

MYSQL *conn;
MYSQL_RES *res;
MYSQL_ROW row;
	
char *server = "127.0.0.1";
char *user ="thuannguyen";
char *password = "2012"; /* set me first */
char *database = "parking";

void ket_noi_DB()//GỬI TỔNG SỐ XE
{
	    conn = mysql_init(NULL);
		if (mysql_real_connect(conn, server,user, password, database, 0, NULL, 0) == NULL)
             {
                fprintf(stderr, "%s\n", mysql_error(conn));
                mysql_close(conn);
                exit(1);
            }
        char sql[10000];
		
		
        sprintf(sql, "insert into park (totalcar) values (%d)",data);
        mysql_query(conn,sql);
        mysql_close(conn);
}

/////////////////////////////////////////////////////////////////////////LƯU KẾT QUẢ TỪNG VỊ TRÍ
void ket_noi_DB1()
{
	conn = mysql_init(NULL);
        if (mysql_real_connect(conn, server,user, password, database, 0, NULL, 0) == NULL)
             {
                fprintf(stderr, "%s\n", mysql_error(conn));
                mysql_close(conn);
                exit(1);
            }
        char sql[10000];
        sprintf(sql, "update slot set space=(%d) where stt=(%d)",cb,stt);
		mysql_query(conn,sql);
        mysql_close(conn);
}

///////////////////////////////////////////////////////////////////
void CBien1(void)
	{
    
	if(digitalRead(CB1)==0  )//phat hien
		{
		 delay(2000);
		
		  if(data <6)
		  {
			  data++;
			  

		  }			 
		   ket_noi_DB();
		   printf("CB1 phát hiện vật \n ");
           printf("Tong so xe:%d \n",data);	 
		}			
		}
	
	
	
///////////////////////////////////////////////////////////////
void CBien2(void)
	{
	
	if(digitalRead(CB2)==0  )//phat hien
		 {
			
		 delay(2000);
		
		   if(data > 0)
		   {
			   
			   data--;
			 
		   }
		   ket_noi_DB();	
		   printf("CB2 phát hiện vật \n ");
           printf("Tong so xe:%d \n",data);
		}
	 }
       	
		
		

////////////////////////////////////////////////////////////////////////
void CBien3(void)
{
	stt = 1;
	if(digitalRead(CB3) == 0){delay(300);cb= 1;} 
	else					  cb= 0;
	printf("cb3: %d\n", cb);
	ket_noi_DB1();
}
//////////////////////////////////////////////////////////////////////////
void CBien4(void)
{
	stt = 2;
	if(digitalRead(CB4) == 0) {delay(350);cb= 1;}
	else					  cb= 0;
	printf("cb4: %d\n", cb);
	ket_noi_DB1();
}
//////////////////////////////////////////////////////////////////////////
void CBien5(void)
{
	stt = 3;
	if(digitalRead(CB5) == 0) {delay(400);cb= 1;}
	else					  cb= 0;
	printf("cb5: %d\n", cb);
	ket_noi_DB1();
}
//////////////////////////////////////////////////////////////////////////
void CBien6(void)
{
	stt = 4;
	if(digitalRead(CB6) == 0) {delay(300);cb= 1;}
	else					  cb= 0;
	printf("cb6: %d\n", cb);
	ket_noi_DB1();
}
//////////////////////////////////////////////////////////////////////////
void CBien7(void)
{
	stt = 5;
	if(digitalRead(CB7) == 0) {delay(300);cb= 1;}
	else					  cb= 0;
	printf("cb7: %d\n", cb);
	ket_noi_DB1();
	
}
//////////////////////////////////////////////////////////////////////////
void CBien8(void)
{
	stt = 6;
	if(digitalRead(CB8) == 0){delay(300);cb= 1;}
	else					  cb= 0;
	printf("cb8: %d\n", cb);
	ket_noi_DB1();
	
	
}
//////////////////////////////////////////////////////////////////////////
int main()
{
	
	//setup thu vien wiringPi
	wiringPiSetupPhys();
	//khai bao IO
	pinMode(CB1,INPUT);
	pinMode(step,OUTPUT);
	pinMode(dir,OUTPUT);
	
	pinMode(CB2,INPUT);
	pinMode(step1,OUTPUT);
	pinMode(dir1,OUTPUT);
	
	pinMode(CB3,INPUT);
	pinMode(CB4,INPUT);
	pinMode(CB5,INPUT);
	pinMode(CB6,INPUT);
	pinMode(CB7,INPUT);
	pinMode(CB8,INPUT);
	//khai bao ngat
	wiringPiISR(CB1,INT_EDGE_RISING,&CBien1);
	wiringPiISR(CB2,INT_EDGE_RISING,&CBien2);
	/////////////////////////////////////////////////
	wiringPiISR(CB3,INT_EDGE_BOTH,&CBien3);
	wiringPiISR(CB4,INT_EDGE_BOTH,&CBien4);
	wiringPiISR(CB5,INT_EDGE_BOTH,&CBien5);
	wiringPiISR(CB6,INT_EDGE_BOTH,&CBien6);
	wiringPiISR(CB7,INT_EDGE_BOTH,&CBien7);
	wiringPiISR(CB8,INT_EDGE_BOTH,&CBien8);
	while(1)
	{
       
    }
    return 0;
}