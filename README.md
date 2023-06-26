
# Dairy Farm Automation -- Semester Project

This system is aimed to automate a dairy farm inclusing business management, animal management and feed. 
It provides a gateway to the farmers to keep track of their animals in terms of their health, profit, production. Further, it helps in business by connecting the farmers to milk markets where they can have business with multiple milk stores.
It also connectes the farms with doctors and feed stores.

## DB Schema
### Production:
###### FieldName                                     Type
AnimalID                                    int(10) NOT NULL\
Date                                      date NOT NULL\
time                                     int(3) NULL\
milk                                     int(10) NULL

##### command:
###### CREATE TABLE PRODUCTION { ANIMALID int(10) NOT NULL , Date date NOT NULL , times int(3) DEFAULT 0, milk int(10) DEFAULT 0 }





