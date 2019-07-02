create database ajedrez;

create table jugador(
	idJugador int not null identity
	,color varchar (15)
	,CONSTRAINT PK_jugador PRIMARY KEY(idJugador)
)

create table Partida(
	  idPartida int not null identity
	 ,idJugador int 
	 ,codigoJugada varchar(45)
,CONSTRAINT PK_Partida PRIMARY KEY(idPartida)	 
,CONSTRAINT FK_Partida_Jugador FOREIGN KEY (idJugador) REFERENCES jugador(idJugador)
)

create table piezas(
	 idPieza int not null identity	
	,idPartida int
	,nroPieza int
	,nombrePieza varchar (50)
,CONSTRAINT PK_piezas PRIMARY KEY(idPieza)	 
,CONSTRAINT FK_Piezas_Partida FOREIGN KEY (idPartida) REFERENCES Partida(idPartida)	
)

create table movimientos(
	idMovimiento int not null identity
	,idjugador int
	,idPartida int
	,idPieza int
	,posicionFinal varchar (10)
	,CONSTRAINT PK_movimientos PRIMARY KEY(idMovimiento)	 
,CONSTRAINT FK_movimientos_jugador FOREIGN KEY (idJugador) REFERENCES jugador(idJugador)
,CONSTRAINT FK_movimientos_Partida FOREIGN KEY (idPartida) REFERENCES Partida(idPartida)
,CONSTRAINT FK_movimientos_piezas FOREIGN KEY (idPieza) REFERENCES piezas(idPieza)	
)


---------------------mysql--------------------------------------------------------

create table jugador( 
idJugador int not null AUTO_INCREMENT ,
color varchar (15) ,
CONSTRAINT PK_jugador PRIMARY KEY(idJugador) 
)

create table Partida(
	  idPartida int not null AUTO_INCREMENT 
	 ,idJugador int 
	 ,codigoJugada varchar(45)
,CONSTRAINT PK_Partida PRIMARY KEY(idPartida)	 
,CONSTRAINT FK_Partida_Jugador FOREIGN KEY (idJugador) REFERENCES jugador(idJugador)

)



create table piezas(
	 idPieza int not null AUTO_INCREMENT 
	,idPartida int
	,nroPieza int
	,nombrePieza varchar (50)
,CONSTRAINT PK_piezas PRIMARY KEY(idPieza)	 
,CONSTRAINT FK_Piezas_Partida FOREIGN KEY (idPartida) REFERENCES Partida(idPartida)	
)

create table movimientos(
	idMovimiento int not null AUTO_INCREMENT 
	,idjugador int
	,idPartida int
	,idPieza int
	,posicionFinal varchar (10)
	,CONSTRAINT PK_movimientos PRIMARY KEY(idMovimiento)	 
,CONSTRAINT FK_movimientos_jugador FOREIGN KEY (idJugador) REFERENCES jugador(idJugador)
,CONSTRAINT FK_movimientos_Partida FOREIGN KEY (idPartida) REFERENCES Partida(idPartida)
,CONSTRAINT FK_movimientos_piezas FOREIGN KEY (idPieza) REFERENCES piezas(idPieza)	
)





insert into jugador VALUES (1, 'NEGRO');
insert into jugador VALUES (2, 'BLANCO');

