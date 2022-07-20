CREATE TABLE system_group (
    id INTEGER PRIMARY KEY NOT NULL,
    name varchar(100));

INSERT INTO system_group (id,name) VALUES ('1','Super-Admin');
INSERT INTO system_group (id,name) VALUES ('2','Currículo');
INSERT INTO system_group (id,name) VALUES ('3','Admin CV');

CREATE TABLE system_program (
    id INTEGER PRIMARY KEY NOT NULL,
    name varchar(100),
    controller varchar(100));

INSERT INTO system_program (id,name,controller) VALUES ('1','System Group Form','SystemGroupForm');
INSERT INTO system_program (id,name,controller) VALUES ('2','System Group List','SystemGroupList');
INSERT INTO system_program (id,name,controller) VALUES ('3','System Program Form','SystemProgramForm');
INSERT INTO system_program (id,name,controller) VALUES ('4','System Program List','SystemProgramList');
INSERT INTO system_program (id,name,controller) VALUES ('5','System User Form','SystemUserForm');
INSERT INTO system_program (id,name,controller) VALUES ('6','System User List','SystemUserList');
INSERT INTO system_program (id,name,controller) VALUES ('7','Common Page','CommonPage');
INSERT INTO system_program (id,name,controller) VALUES ('8','System PHP Info','SystemPHPInfoView');
INSERT INTO system_program (id,name,controller) VALUES ('9','System ChangeLog View','SystemChangeLogView');
INSERT INTO system_program (id,name,controller) VALUES ('10','Welcome View','WelcomeView');
INSERT INTO system_program (id,name,controller) VALUES ('11','System Sql Log','SystemSqlLogList');
INSERT INTO system_program (id,name,controller) VALUES ('12','System Profile View','SystemProfileView');
INSERT INTO system_program (id,name,controller) VALUES ('13','System Profile Form','SystemProfileForm');
INSERT INTO system_program (id,name,controller) VALUES ('14','System SQL Panel','SystemSQLPanel');
INSERT INTO system_program (id,name,controller) VALUES ('15','System Access Log','SystemAccessLogList');
INSERT INTO system_program (id,name,controller) VALUES ('16','System Message Form','SystemMessageForm');
INSERT INTO system_program (id,name,controller) VALUES ('17','System Message List','SystemMessageList');
INSERT INTO system_program (id,name,controller) VALUES ('18','System Message Form View','SystemMessageFormView');
INSERT INTO system_program (id,name,controller) VALUES ('19','System Notification List','SystemNotificationList');
INSERT INTO system_program (id,name,controller) VALUES ('20','System Notification Form View','SystemNotificationFormView');
INSERT INTO system_program (id,name,controller) VALUES ('21','System Document Category List','SystemDocumentCategoryFormList');
INSERT INTO system_program (id,name,controller) VALUES ('22','System Document Form','SystemDocumentForm');
INSERT INTO system_program (id,name,controller) VALUES ('23','System Document Upload Form','SystemDocumentUploadForm');
INSERT INTO system_program (id,name,controller) VALUES ('24','System Document List','SystemDocumentList');
INSERT INTO system_program (id,name,controller) VALUES ('25','System Shared Document List','SystemSharedDocumentList');
INSERT INTO system_program (id,name,controller) VALUES ('26','System Unit Form','SystemUnitForm');
INSERT INTO system_program (id,name,controller) VALUES ('27','System Unit List','SystemUnitList');
INSERT INTO system_program (id,name,controller) VALUES ('28','System Access stats','SystemAccessLogStats');
INSERT INTO system_program (id,name,controller) VALUES ('29','System Preference form','SystemPreferenceForm');
INSERT INTO system_program (id,name,controller) VALUES ('30','System Support form','SystemSupportForm');
INSERT INTO system_program (id,name,controller) VALUES ('31','System PHP Error','SystemPHPErrorLogView');
INSERT INTO system_program (id,name,controller) VALUES ('32','System Database Browser','SystemDatabaseExplorer');
INSERT INTO system_program (id,name,controller) VALUES ('33','System Table List','SystemTableList');
INSERT INTO system_program (id,name,controller) VALUES ('34','System Data Browser','SystemDataBrowser');
INSERT INTO system_program (id,name,controller) VALUES ('35','Currículo Usuario','SystemUserCvForm');
INSERT INTO system_program (id,name,controller) VALUES ('36','Tipos Form','TiposForm');
INSERT INTO system_program (id,name,controller) VALUES ('37','Visualizar Currículo','VisualizaCv');
INSERT INTO system_program (id,name,controller) VALUES ('38','Listagem Currículos','ListagemCurriculos');
INSERT INTO system_program (id,name,controller) VALUES ('39','View Curriculo Adm','ViewCurriculo');
INSERT INTO system_program (id,name,controller) VALUES ('40','Lista de Vagas','ListaDeVagas');
INSERT INTO system_program (id,name,controller) VALUES ('41','Cadastro de Vagas','CadVagasForm');
INSERT INTO system_program (id,name,controller) VALUES ('42','Lista Vagas Disponiveis','ListaVagasDisponiveis');
INSERT INTO system_program (id,name,controller) VALUES ('43','Visualiza Candidatos','VisualizaCandidatos');
INSERT INTO system_program (id,name,controller) VALUES ('44','Cad Curriculo01','CadCurriculo01');
INSERT INTO system_program (id,name,controller) VALUES ('45','Cad Curriculo02','CadCurriculo02');
INSERT INTO system_program (id,name,controller) VALUES ('46','Cad Curriculo03','CadCurriculo03');
INSERT INTO system_program (id,name,controller) VALUES ('47','Cad Curriculo04','CadCurriculo04');

CREATE TABLE system_unit (
    id INTEGER PRIMARY KEY NOT NULL,
    name varchar(100));

CREATE TABLE system_preference (
    id text,
    value text
);

CREATE TABLE system_user (
    id INTEGER PRIMARY KEY NOT NULL,
    name varchar(100),
    login varchar(100),
    password varchar(100),
    email varchar(100),
    frontpage_id int, 
    system_unit_id int references system_unit(id), 
    active char(1), 
    cpf TEXT, 
    rg TEXT, 
    fone TEXT, 
    celular TEXT, 
    sexo TEXT, 
    dtnasc TEXT, 
    estcivil TEXT, 
    endereco TEXT, 
    bairro TEXT, 
    cep TEXT, 
    cidade TEXT, 
    estado TEXT, 
    pais TEXT, 
    dispvia TEXT, 
    dispmud TEXT, 
    diasdisponivel TEXT, 
    turnosdisponivel TEXT, 
    estaempregado TEXT, 
    cnh TEXT, 
    objetivo TEXT, 
    pretsalarial NUMERIC, 
    arquivo BLOB, 
    status TEXT, 
    necespecial TEXT, 
    qualnecespecial TEXT, 
    cargopretende TEXT, 
    dtcriacao TEXT, 
    dtatualiza TEXT,
    FOREIGN KEY(frontpage_id) REFERENCES system_program(id));

INSERT INTO system_user (id,name,login,password,email,frontpage_id,system_unit_id,active,cpf,rg,fone,celular,sexo,dtnasc,estcivil,endereco,bairro,cep,cidade,estado,pais,dispvia,dispmud,diasdisponivel,turnosdisponivel,estaempregado,cnh,objetivo,pretsalarial,arquivo,status,necespecial,qualnecespecial,cargopretende,dtcriacao,dtatualiza) VALUES ('1','Super Administrator','admin','4594ea97fcd2fedcab7b1c39ee3d707e','willian.wagner@.com.br','10',NULL,'Y','040.433.539-01','414101','(48)3444-5555','(48)99647-4848','Masculino','26/11/1982','Casado','teste','teste','88813-160','Criciúma','SC','Brasil','SIM','SIM',NULL,NULL,'SIM','AB','teste','15225',NULL,'F','NÃO',NULL,NULL,'2019-02-18 23:02:28','2019-04-11 19:17:18');
INSERT INTO system_user (id,name,login,password,email,frontpage_id,system_unit_id,active,cpf,rg,fone,celular,sexo,dtnasc,estcivil,endereco,bairro,cep,cidade,estado,pais,dispvia,dispmud,diasdisponivel,turnosdisponivel,estaempregado,cnh,objetivo,pretsalarial,arquivo,status,necespecial,qualnecespecial,cargopretende,dtcriacao,dtatualiza) VALUES ('4','Administrador','adm','e00cf25ad42683b3df678c61f42c6bda','will.wag@gmail.com','38',NULL,'Y',NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,'2019-02-21 23:02:28','2019-02-21 23:02:28');
INSERT INTO system_user (id,name,login,password,email,frontpage_id,system_unit_id,active,cpf,rg,fone,celular,sexo,dtnasc,estcivil,endereco,bairro,cep,cidade,estado,pais,dispvia,dispmud,diasdisponivel,turnosdisponivel,estaempregado,cnh,objetivo,pretsalarial,arquivo,status,necespecial,qualnecespecial,cargopretende,dtcriacao,dtatualiza) VALUES ('5','William O Wagner','User','ee11cbb19052e40b07aac0ca060c23ee','will.wag@gmail.com','44',NULL,'Y','000.000.000-00','00000000','(48)9963-7960','(48)99637-9600','Masculino','26/02/2020','Casado','Rua Aracajú, 235, Casa','Brasil','88813160','Criciúma','SC','Brasil','SIM','SIM',NULL,NULL,'SIM','AB','Ser o melhor da empresa.',NULL,NULL,'F','NÃO',NULL,'CEO','2020-02-05 22:00:30','2020-02-05 22:08:32');
INSERT INTO system_user (id,name,login,password,email,frontpage_id,system_unit_id,active,cpf,rg,fone,celular,sexo,dtnasc,estcivil,endereco,bairro,cep,cidade,estado,pais,dispvia,dispmud,diasdisponivel,turnosdisponivel,estaempregado,cnh,objetivo,pretsalarial,arquivo,status,necespecial,qualnecespecial,cargopretende,dtcriacao,dtatualiza) VALUES ('6','Sadmin','Sadmin'.'0d05b909c125e1cd72b3823a48e02a59','admin@mail.com','10',NULL,'Y','987.987.789-00','12345678','(51)2345-6789','(51)99876-5544','Masculino','14/07/1989','Solteiro','rua Tendas, 234, Casa','teste','94555000','Capão da Canoa','RS','Brasil','SIM','SIM',NULL,NULL,'SIM','AB','teste','15678',NULL,'F','NÃO',NULL,NULL,'2019-02-18 23:02:28','2019-04-11 19:17:18');

CREATE TABLE system_user_unit (
    id INTEGER PRIMARY KEY NOT NULL,
    system_user_id int,
    system_unit_id int,
    FOREIGN KEY(system_user_id) REFERENCES system_user(id),
    FOREIGN KEY(system_unit_id) REFERENCES system_unit(id));

CREATE TABLE system_user_group (
    id INTEGER PRIMARY KEY NOT NULL,
    system_user_id int,
    system_group_id int,
    FOREIGN KEY(system_user_id) REFERENCES system_user(id),
    FOREIGN KEY(system_group_id) REFERENCES system_group(id));
    
CREATE TABLE system_group_program (
    id INTEGER PRIMARY KEY NOT NULL,
    system_group_id int,
    system_program_id int,
    FOREIGN KEY(system_group_id) REFERENCES system_group(id),
    FOREIGN KEY(system_program_id) REFERENCES system_program(id));

INSERT INTO system_group_program (id,system_group_id,system_program_id) VALUES ('145','2','35');
INSERT INTO system_group_program (id,system_group_id,system_program_id) VALUES ('146','2','37');
INSERT INTO system_group_program (id,system_group_id,system_program_id) VALUES ('147','2','12');
INSERT INTO system_group_program (id,system_group_id,system_program_id) VALUES ('148','2','13');
INSERT INTO system_group_program (id,system_group_id,system_program_id) VALUES ('149','3','38');
INSERT INTO system_group_program (id,system_group_id,system_program_id) VALUES ('150','3','36');
INSERT INTO system_group_program (id,system_group_id,system_program_id) VALUES ('151','3','39');
INSERT INTO system_group_program (id,system_group_id,system_program_id) VALUES ('152','3','12');
INSERT INTO system_group_program (id,system_group_id,system_program_id) VALUES ('153','3','13');
INSERT INTO system_group_program (id,system_group_id,system_program_id) VALUES ('154','3','29');
INSERT INTO system_group_program (id,system_group_id,system_program_id) VALUES ('155','3','15');
INSERT INTO system_group_program (id,system_group_id,system_program_id) VALUES ('156','3','28');
INSERT INTO system_group_program (id,system_group_id,system_program_id) VALUES ('157','1','1');
INSERT INTO system_group_program (id,system_group_id,system_program_id) VALUES ('158','1','2');
INSERT INTO system_group_program (id,system_group_id,system_program_id) VALUES ('159','1','3');
INSERT INTO system_group_program (id,system_group_id,system_program_id) VALUES ('160','1','4');
INSERT INTO system_group_program (id,system_group_id,system_program_id) VALUES ('161','1','5');
INSERT INTO system_group_program (id,system_group_id,system_program_id) VALUES ('162','1','6');
INSERT INTO system_group_program (id,system_group_id,system_program_id) VALUES ('163','1','8');
INSERT INTO system_group_program (id,system_group_id,system_program_id) VALUES ('164','1','9');
INSERT INTO system_group_program (id,system_group_id,system_program_id) VALUES ('165','1','11');
INSERT INTO system_group_program (id,system_group_id,system_program_id) VALUES ('166','1','14');
INSERT INTO system_group_program (id,system_group_id,system_program_id) VALUES ('167','1','15');
INSERT INTO system_group_program (id,system_group_id,system_program_id) VALUES ('168','1','21');
INSERT INTO system_group_program (id,system_group_id,system_program_id) VALUES ('169','1','26');
INSERT INTO system_group_program (id,system_group_id,system_program_id) VALUES ('170','1','27');
INSERT INTO system_group_program (id,system_group_id,system_program_id) VALUES ('171','1','28');
INSERT INTO system_group_program (id,system_group_id,system_program_id) VALUES ('172','1','29');
INSERT INTO system_group_program (id,system_group_id,system_program_id) VALUES ('173','1','31');
INSERT INTO system_group_program (id,system_group_id,system_program_id) VALUES ('174','1','32');
INSERT INTO system_group_program (id,system_group_id,system_program_id) VALUES ('175','1','33');
INSERT INTO system_group_program (id,system_group_id,system_program_id) VALUES ('176','1','34');
INSERT INTO system_group_program (id,system_group_id,system_program_id) VALUES ('177','1','35');
INSERT INTO system_group_program (id,system_group_id,system_program_id) VALUES ('178','1','36');
INSERT INTO system_group_program (id,system_group_id,system_program_id) VALUES ('179','1','10');
INSERT INTO system_group_program (id,system_group_id,system_program_id) VALUES ('180','1','37');
INSERT INTO system_group_program (id,system_group_id,system_program_id) VALUES ('181','1','38');
INSERT INTO system_group_program (id,system_group_id,system_program_id) VALUES ('182','1','39');
INSERT INTO system_group_program (id,system_group_id,system_program_id) VALUES ('183','1','12');
INSERT INTO system_group_program (id,system_group_id,system_program_id) VALUES ('184','1','13');
INSERT INTO system_group_program (id,system_group_id,system_program_id) VALUES ('185','1','40');
INSERT INTO system_group_program (id,system_group_id,system_program_id) VALUES ('186','3','40');
INSERT INTO system_group_program (id,system_group_id,system_program_id) VALUES ('187','1','41');
INSERT INTO system_group_program (id,system_group_id,system_program_id) VALUES ('188','3','41');
INSERT INTO system_group_program (id,system_group_id,system_program_id) VALUES ('189','1','42');
INSERT INTO system_group_program (id,system_group_id,system_program_id) VALUES ('190','2','42');
INSERT INTO system_group_program (id,system_group_id,system_program_id) VALUES ('191','1','43');
INSERT INTO system_group_program (id,system_group_id,system_program_id) VALUES ('192','3','43');
INSERT INTO system_group_program (id,system_group_id,system_program_id) VALUES ('193','1','44');
INSERT INTO system_group_program (id,system_group_id,system_program_id) VALUES ('194','2','44');
INSERT INTO system_group_program (id,system_group_id,system_program_id) VALUES ('195','1','45');
INSERT INTO system_group_program (id,system_group_id,system_program_id) VALUES ('196','2','45');
INSERT INTO system_group_program (id,system_group_id,system_program_id) VALUES ('197','1','46');
INSERT INTO system_group_program (id,system_group_id,system_program_id) VALUES ('198','2','46');
INSERT INTO system_group_program (id,system_group_id,system_program_id) VALUES ('199','1','47');
INSERT INTO system_group_program (id,system_group_id,system_program_id) VALUES ('200','2','47');

CREATE TABLE system_user_program (
    id INTEGER PRIMARY KEY NOT NULL,
    system_user_id int,
    system_program_id int,
    FOREIGN KEY(system_user_id) REFERENCES system_user(id),
    FOREIGN KEY(system_program_id) REFERENCES system_program(id));
  
CREATE TABLE experiencias(
  id INT PRIMARY KEY NOT NULL, 
  empresa TEXT, cargo TEXT, dtini TEXT, dtfim TEXT, atividade TEXT, id_user INT, atual TEXT);

CREATE TABLE formacao (
	id INTEGER PRIMARY KEY  NOT NULL,
	curso TEXT,
	instituicao TEXT,
	status TEXT,
	tipo TEXT,
	dtini TEXT,
	dtfim TEXT,
	id_user INT
);

CREATE TABLE idiomas (
	id INTEGER PRIMARY KEY  NOT NULL,
	lingua TEXT,
	compreensao TEXT,
	escrita TEXT,
	fala TEXT,
	leitura TEXT,
	id_user INT
);

CREATE TABLE tipos (
	id INTEGER PRIMARY KEY  NOT NULL,
	descricao TEXT
, sigla TEXT);

CREATE TABLE user_tipos (
	id INTEGER PRIMARY KEY  NOT NULL,
	id_user int,
	id_tipo int
);

CREATE TABLE vagas (
	id INTEGER,
	nome TEXT,
	descricao TEXT,
	conhecimento TEXT,
	prerequisito TEXT,
	salario NUMERIC,
	beneficio TEXT,
	datacriacao date,
	datafinal date,
    email text,
	status INTEGER, solicitante TEXT, tipo INTEGER,
	CONSTRAINT vagas_PK PRIMARY KEY (id)
);

CREATE TABLE vaga_user (
	id INTEGER,
	id_user INTEGER,
	id_vaga INTEGER,
	datacan TEXT,
	CONSTRAINT vaga_user_PK PRIMARY KEY (id),
	CONSTRAINT vaga_user_system_user_FK FOREIGN KEY (id_user) REFERENCES system_user(id),
	CONSTRAINT vaga_user_vagas_FK FOREIGN KEY (id_vaga) REFERENCES vagas(id)
);

CREATE INDEX system_user_program_idx ON system_user(frontpage_id);

CREATE INDEX system_user_group_group_idx ON system_user_group(system_group_id);

CREATE INDEX system_user_group_user_idx ON system_user_group(system_user_id);

CREATE INDEX system_group_program_program_idx ON system_group_program(system_program_id);

CREATE INDEX system_group_program_group_idx ON system_group_program(system_group_id);

CREATE INDEX system_user_program_program_idx ON system_user_program(system_program_id);

CREATE INDEX system_user_program_user_idx ON system_user_program(system_user_id);
