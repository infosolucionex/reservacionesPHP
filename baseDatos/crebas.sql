/*==============================================================*/
/* DBMS name:      MySQL 5.0                                    */
/* Created on:     24/8/2021 13:29:14                           */
/*==============================================================*/


create database reservacionesPHP;
use reservacionesPHP;

/*==============================================================*/
/* Table: HABITACION                                            */
/*==============================================================*/
create table HABITACION
(
   ID_HABITACION        int not null auto_increment,
   TIPOHABI             varchar(100),
   TIPODCAMA            varchar(100),
   PRECIO               double,
   primary key (ID_HABITACION)
);

/*==============================================================*/
/* Table: PERSONA                                               */
/*==============================================================*/
create table PERSONA
(
   ID_PERSONA           int not null auto_increment,
   NOMBRE               varchar(50),
   APELLIDO             varchar(50),
   TELEFONO             varchar(10),
   GENERO               varchar(50),
   FECHANAC             date,
   CIUDADRECIDENCIA     varchar(100),
   CORREO               varchar(100),
   primary key (ID_PERSONA)
);

/*==============================================================*/
/* Table: RESERVACION                                           */
/*==============================================================*/
create table RESERVACION
(
   ID_RESERVACION       int not null auto_increment,
   ID_HABITACION        int,
   CLI_ID_ROL           int,
   CLI_ID_PERSONA       int,
   FECHAINICIO          datetime,
   FECHAFIN             datetime,
   ESTADO               boolean,
   primary key (ID_RESERVACION)
);

/*==============================================================*/
/* Table: ROLES                                                 */
/*==============================================================*/
create table ROLES
(
   ID_ROL               int not null auto_increment,
   ROL                  varchar(50),
   primary key (ID_ROL)
);

/*==============================================================*/
/* Table: USUARIOS                                              */
/*==============================================================*/
create table USUARIOS
(
   ID_ROL               int not null,
   ID_PERSONA           int not null,
   NOMBREUSUARIO        varchar(50),
   CLAVE                varchar(50),
   ESTADO               boolean,
   primary key (ID_ROL, ID_PERSONA)
);

/*==============================================================*/
/* Index: UK_NOMBREUSER                                         */
/*==============================================================*/
create unique index UK_NOMBREUSER on USUARIOS
(
   NOMBREUSUARIO
);

alter table RESERVACION add constraint FK_REFERENCE_3 foreign key (ID_HABITACION)
      references HABITACION (ID_HABITACION) on delete restrict on update restrict;

alter table RESERVACION add constraint FK_REFERENCE_4 foreign key (CLI_ID_ROL, CLI_ID_PERSONA)
      references USUARIOS (ID_ROL, ID_PERSONA) on delete restrict on update restrict;

alter table USUARIOS add constraint FK_REFERENCE_1 foreign key (ID_ROL)
      references ROLES (ID_ROL) on delete restrict on update restrict;

alter table USUARIOS add constraint FK_REFERENCE_2 foreign key (ID_PERSONA)
      references PERSONA (ID_PERSONA) on delete restrict on update restrict;




/*==============================================================*/
/*DATOS DE PRUEBA*/
/*TABLA ROLES*/
select * from roles;
insert into roles(rol) values('administrador');
insert into roles(rol) values('cliente');

/*PERSONA*/
select * from persona;
insert into persona(nombre,apellido,telefono,genero,fechanac,ciudadrecidencia,correo)
values('Carlos','Andrade',09999999,'masculino','1998-06-16','Ibarra','correo@gmail.com');
insert into persona(nombre,apellido,telefono,genero,fechanac,ciudadrecidencia,correo)
values('Andrea','Peralta',09999999,'femenino','1998-06-16','Ibarra','correo@gmail.com');
insert into persona(nombre,apellido,telefono,genero,fechanac,ciudadrecidencia,correo)
values('Eduardo','Olivo',09999999,'femenino','1998-06-16','Ibarra','correo@gmail.com');

/*TABLA USUARIOS*/
select * from usuarios;
insert into usuarios(id_rol,id_persona,nombreusuario,clave,estado) 
values(2,1,'carloscli','123456',true);
insert into usuarios(id_rol,id_persona,nombreusuario,clave,estado) 
values(2,2,'andreacli','123456',true);
insert into usuarios(id_rol,id_persona,nombreusuario,clave,estado) 
values(1,3,'eduardindev','123456',true);

/*TABLA HABITACION*/
select * from habitacion;
insert into habitacion(tipohabi,tipodcama,precio) values('king','matrimonial',35.0);
insert into habitacion(tipohabi,tipodcama,precio) values('doble','mediana',35.0);
insert into habitacion(tipohabi,tipodcama,precio) values('individual','individual',35.0);

/*TABLA RESERVACIÓN*/
select * from reservacion;
insert into reservacion(id_habitacion,cli_id_rol,cli_id_persona,fechainicio,fechafin,estado)
values(1,2,2,'2021-08-30 00:00:00','2021-08-31 00:00:00',true);
insert into reservacion(id_habitacion,cli_id_rol,cli_id_persona,fechainicio,fechafin,estado)
values(2,2,1,'2021-08-30 00:00:00','2021-08-31 00:00:00',true);


