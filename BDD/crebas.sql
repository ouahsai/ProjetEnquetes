/*==============================================================*/
/* DBMS name:      MySQL 5.0                                    */
/* Created on:     29/04/2014 15:23:16                          */
/*==============================================================*/


drop table if exists ENQUETE;

drop table if exists QCM;

drop table if exists QUESTION;

drop table if exists REPONSE;

drop table if exists TYPE_QUESTION;

drop table if exists UTILISATEUR;

/*==============================================================*/
/* Table: ENQUETE                                               */
/*==============================================================*/
create table ENQUETE
(
   ID_ENQUETE           int not null auto_increment,
   ID_UTILISATEUR       int not null,
   TITRE                varchar(255) not null,
   DESCRIPTION          varchar(512),
   primary key (ID_ENQUETE)
);

/*==============================================================*/
/* Table: QCM                                                   */
/*==============================================================*/
create table QCM
(
   ID_QCM               int not null auto_increment,
   ID_QUESTION          int not null,
   VALEUR_QCM           varchar(50),
   primary key (ID_QCM)
);

/*==============================================================*/
/* Table: QUESTION                                              */
/*==============================================================*/
create table QUESTION
(
   ID_QUESTION          int not null auto_increment,
   ID_ENQUETE           int not null,
   ID_TYPE_QUESTION     int not null,
   LIBELLE_QUESTION     varchar(255) not null,
   primary key (ID_QUESTION)
);

/*==============================================================*/
/* Table: REPONSE                                               */
/*==============================================================*/
create table REPONSE
(
   ID_REPONSE           int not null auto_increment,
   ID_QUESTION          int not null,
   VALEUR_REPONSE       varchar(512) not null,
   UNIQUE_USER_ID       varchar(128) not null,
   primary key (ID_REPONSE)
);

/*==============================================================*/
/* Table: TYPE_QUESTION                                         */
/*==============================================================*/
create table TYPE_QUESTION
(
   ID_TYPE_QUESTION          int not null auto_increment,
   LIBELLE_TYPE_QUESTION     varchar(255) not null,
   primary key (ID_TYPE_QUESTION)
);

/*==============================================================*/
/* Table: UTILISATEUR                                           */
/*==============================================================*/
create table UTILISATEUR
(
   ID_UTILISATEUR       int not null auto_increment,
   NOM                  varchar(255) not null,
   PRENOM               varchar(255) not null,
   EMAIL                varchar(255) not null,
   PASSWORD             varchar(50) not null,
   primary key (ID_UTILISATEUR),
   key AK_IDENTIFIER_2 (EMAIL)
);

alter table ENQUETE add constraint FK_CREER foreign key (ID_UTILISATEUR)
      references UTILISATEUR (ID_UTILISATEUR) on delete restrict on update restrict;

alter table QCM add constraint FK_A_POUR_VALEUR_QCM foreign key (ID_QUESTION)
      references QUESTION (ID_QUESTION) on delete restrict on update restrict;

alter table QUESTION add constraint FK_EST_COMPOSEE foreign key (ID_ENQUETE)
      references ENQUETE (ID_ENQUETE) on delete restrict on update restrict;

alter table QUESTION add constraint FK_EST_DE_TYPE foreign key (ID_TYPE_QUESTION)
      references TYPE_QUESTION (ID_TYPE_QUESTION) on delete restrict on update restrict;

alter table REPONSE add constraint FK_REPOND_A_LA_QUESTION foreign key (ID_QUESTION)
      references QUESTION (ID_QUESTION) on delete restrict on update restrict;

