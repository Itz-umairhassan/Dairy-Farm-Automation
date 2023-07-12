
# Dairy Farm Automation -- Semester Project

This system is aimed to automate a dairy farm inclusing business management, animal management and feed. 
It provides a gateway to the farmers to keep track of their animals in terms of their health, profit, production. Further, it helps in business by connecting the farmers to milk markets where they can have business with multiple milk stores.
It also connectes the farms with doctors and feed stores.

## DB Schema
### Production:
###### CREATE TABLE PRODUCTION { ANIMALID int(10) NOT NULL , Date date NOT NULL , times int(3) DEFAULT 0, milk int(10) DEFAULT 0 }

### Animal Related Sale:
###### CREATE TABLE animalsale ( animalid int(10) NOT NULL, date date NOT NULL, sale int(10) NOT NULL,agent varchar(100) NOT NULL, earning int(10) NOT NULL, quantity int(10) NOT NULL, status varchar(100) NOT NULL}

### Animal:
###### CREATE TABLE animal (id int(8) NOT NULL AUTO_INCREMENT PRIMARY KEY,price int(10) NOT NULL,species varchar(300) NOT NULL,grp varchar(300) NOT NULL,healthy tinyint(1) NOT NULL,pregnant tinyint(1) NOT NULL,calculation varchar(50) DEFAULT '"0,0"'}

### Production:
###### CREATE TABLE production (AnimalID int(10) NOT NULL,Date date NOT NULL,times int(3) DEFAULT 0,milk int(10) DEFAULT 0}




