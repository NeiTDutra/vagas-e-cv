<?php
/**
 * ApplicationTranslator
 *
 * @version    5.6
 * @package    util
 * @author     Pablo Dall'Oglio
 * @copyright  Copyright (c) 2006 Adianti Solutions Ltd. (http://www.adianti.com.br)
 * @license    http://www.adianti.com.br/framework-license
 */
class ApplicationTranslator
{
    private static $instance; // singleton instance
    private $messages;
    private $enWords;
    private $lang;            // target language
    
    /**
     * Class Constructor
     */
    private function __construct()
    {
        $this->messages['en'][] = 'File not found';
        $this->messages['en'][] = 'Search';
        $this->messages['en'][] = 'Register';
        $this->messages['en'][] = 'Record saved';
        $this->messages['en'][] = 'Do you really want to delete ?';
        $this->messages['en'][] = 'Record deleted';
        $this->messages['en'][] = 'Function';
        $this->messages['en'][] = 'Table';
        $this->messages['en'][] = 'Tool';
        $this->messages['en'][] = 'Data';
        $this->messages['en'][] = 'Open';
        $this->messages['en'][] = 'New';
        $this->messages['en'][] = 'Save';
        $this->messages['en'][] = 'Find';
        $this->messages['en'][] = 'Edit';
        $this->messages['en'][] = 'Delete';
        $this->messages['en'][] = 'Cancel';
        $this->messages['en'][] = 'Yes';
        $this->messages['en'][] = 'No';
        $this->messages['en'][] = 'January';
        $this->messages['en'][] = 'February';
        $this->messages['en'][] = 'March';
        $this->messages['en'][] = 'April';
        $this->messages['en'][] = 'May';
        $this->messages['en'][] = 'June';
        $this->messages['en'][] = 'July';
        $this->messages['en'][] = 'August';
        $this->messages['en'][] = 'September';
        $this->messages['en'][] = 'October';
        $this->messages['en'][] = 'November';
        $this->messages['en'][] = 'December';
        $this->messages['en'][] = 'Today';
        $this->messages['en'][] = 'Close';
        $this->messages['en'][] = 'The field ^1 can not be less than ^2 characters';
        $this->messages['en'][] = 'The field ^1 can not be greater than ^2 characters';
        $this->messages['en'][] = 'The field ^1 can not be less than ^2';
        $this->messages['en'][] = 'The field ^1 can not be greater than ^2';
        $this->messages['en'][] = 'The field ^1 is required';
        $this->messages['en'][] = 'The field ^1 has not a valid CNPJ';
        $this->messages['en'][] = 'The field ^1 has not a valid CPF';
        $this->messages['en'][] = 'The field ^1 contains an invalid e-mail';
        $this->messages['en'][] = 'Permission denied';
        $this->messages['en'][] = 'Generate';
        $this->messages['en'][] = 'List';
        $this->messages['en'][] = 'Wrong password';
        $this->messages['en'][] = 'User not found';
        $this->messages['en'][] = 'User';
        $this->messages['en'][] = 'Users';
        $this->messages['en'][] = 'Password';
        $this->messages['en'][] = 'Login';
        $this->messages['en'][] = 'Name';
        $this->messages['en'][] = 'Group';
        $this->messages['en'][] = 'Groups';
        $this->messages['en'][] = 'Program';
        $this->messages['en'][] = 'Programs';
        $this->messages['en'][] = 'Back to the listing';
        $this->messages['en'][] = 'Controller';
        $this->messages['en'][] = 'Email';
        $this->messages['en'][] = 'Record Updated';
        $this->messages['en'][] = 'Password confirmation';
        $this->messages['en'][] = 'Front page';
        $this->messages['en'][] = 'Page name';
        $this->messages['en'][] = 'The passwords do not match';
        $this->messages['en'][] = 'Log in';
        $this->messages['en'][] = 'Date';
        $this->messages['en'][] = 'Column';
        $this->messages['en'][] = 'Operation';
        $this->messages['en'][] = 'Old value';
        $this->messages['en'][] = 'New value';
        $this->messages['en'][] = 'Database';
        $this->messages['en'][] = 'Profile';
        $this->messages['en'][] = 'Change password';
        $this->messages['en'][] = 'Leave empty to keep old password';
        $this->messages['en'][] = 'Results';
        $this->messages['en'][] = 'Invalid command';
        $this->messages['en'][] = '^1 records shown';
        $this->messages['en'][] = 'Administration';
        $this->messages['en'][] = 'SQL Panel';
        $this->messages['en'][] = 'Access Log';
        $this->messages['en'][] = 'Change Log';
        $this->messages['en'][] = 'SQL Log';
        $this->messages['en'][] = 'Clear form';
        $this->messages['en'][] = 'Send';
        $this->messages['en'][] = 'Message';
        $this->messages['en'][] = 'Messages';
        $this->messages['en'][] = 'Subject';
        $this->messages['en'][] = 'Message sent successfully';
        $this->messages['en'][] = 'Check as read';
        $this->messages['en'][] = 'Check as unread';
        $this->messages['en'][] = 'Action';
        $this->messages['en'][] = 'Read';
        $this->messages['en'][] = 'From';
        $this->messages['en'][] = 'Checked';
        $this->messages['en'][] = 'Object ^1 not found in ^2';
        $this->messages['en'][] = 'Notification';
        $this->messages['en'][] = 'Notifications';
        $this->messages['en'][] = 'Categories';
        $this->messages['en'][] = 'Send document';
        $this->messages['en'][] = 'My documents';
        $this->messages['en'][] = 'Shared with me';
        $this->messages['en'][] = 'Document';
        $this->messages['en'][] = 'File';
        $this->messages['en'][] = 'Title';
        $this->messages['en'][] = 'Description';
        $this->messages['en'][] = 'Category';
        $this->messages['en'][] = 'Submission date';
        $this->messages['en'][] = 'Archive date';
        $this->messages['en'][] = 'Upload';
        $this->messages['en'][] = 'Download';
        $this->messages['en'][] = 'Next';
        $this->messages['en'][] = 'Documents';
        $this->messages['en'][] = 'Permission';
        $this->messages['en'][] = 'Unit';
        $this->messages['en'][] = 'Units';
        $this->messages['en'][] = 'Add';
        $this->messages['en'][] = 'Active';
        $this->messages['en'][] = 'Activate/Deactivate';
        $this->messages['en'][] = 'Inactive user';
        $this->messages['en'][] = 'Send message';
        $this->messages['en'][] = 'Read messages';
        $this->messages['en'][] = 'An user with this login is already registered';
        $this->messages['en'][] = 'Access Stats';
        $this->messages['en'][] = 'Accesses';
        $this->messages['en'][] = 'Preferences';
        $this->messages['en'][] = 'Mail from';
        $this->messages['en'][] = 'SMTP Auth';
        $this->messages['en'][] = 'SMTP Host';
        $this->messages['en'][] = 'SMTP Port';
        $this->messages['en'][] = 'SMTP User';
        $this->messages['en'][] = 'SMTP Pass';
        $this->messages['en'][] = 'Ticket';
        $this->messages['en'][] = 'Open ticket';
        $this->messages['en'][] = 'Support mail';
        $this->messages['en'][] = 'Day';
        $this->messages['en'][] = 'Folders';
        $this->messages['en'][] = 'Compose';
        $this->messages['en'][] = 'Inbox';
        $this->messages['en'][] = 'Sent';
        $this->messages['en'][] = 'Archived';
        $this->messages['en'][] = 'Archive';
        $this->messages['en'][] = 'Recover';
        $this->messages['en'][] = 'Value';
        $this->messages['en'][] = 'View all';
        $this->messages['en'][] = 'Reload';
        $this->messages['en'][] = 'Back';
        $this->messages['en'][] = 'Clear';
        $this->messages['en'][] = 'View';
        $this->messages['en'][] = 'No records found';
        $this->messages['en'][] = 'Drawing successfully generated';
        $this->messages['en'][] = 'QR Codes successfully generated';
        $this->messages['en'][] = 'Barcodes successfully generated';
        $this->messages['en'][] = 'Document successfully generated';
        $this->messages['en'][] = 'Value';
        $this->messages['en'][] = 'User';
        $this->messages['en'][] = 'Password';
        $this->messages['en'][] = 'Port';
        $this->messages['en'][] = 'Database type';
        $this->messages['en'][] = 'Root user';
        $this->messages['en'][] = 'Root password';
        $this->messages['en'][] = 'Create database/user';
        $this->messages['en'][] = 'Test connection';
        $this->messages['en'][] = 'Database name';
        $this->messages['en'][] = 'Insert permissions/programs';
        $this->messages['en'][] = 'Database and user created successfully';
        $this->messages['en'][] = 'Permissions and programs successfully inserted';
        $this->messages['en'][] = 'Update config';
        $this->messages['en'][] = 'Configuration file: ^1 updated successfully';
        $this->messages['en'][] = 'Connection successfully completed';
        $this->messages['en'][] = "The database ^1 doesn't exists";
        $this->messages['en'][] = 'Permissions/programs successfully inserted';
        $this->messages['en'][] = 'Programs/permissions have already been inserted';
        $this->messages['en'][] = 'Installing your application';
        $this->messages['en'][] = 'PHP version verification and installed extensions';
        $this->messages['en'][] = 'PHP verification';
        $this->messages['en'][] = 'Directory and files verification';
        $this->messages['en'][] = 'Database configuration/creation';
        $this->messages['en'][] = 'Admin user';
        $this->messages['en'][] = 'Admin password';
        $this->messages['en'][] = 'Insert data';
        $this->messages['en'][] = 'Of database:';
        $this->messages['en'][] = 'Connecton to database ^1 failed';
        $this->messages['en'][] = 'Install';
        $this->messages['en'][] = 'Databases successfully installed';
        $this->messages['en'][] = 'Databases have already been installed';
        $this->messages['en'][] = 'Main unit';
        $this->messages['en'][] = 'Time';
        $this->messages['en'][] = 'Type';
        $this->messages['en'][] = 'Failed to read error log (^1)';
        $this->messages['en'][] = 'Error log (^1) is not writable by web server user, so the messages may be incomplete';
        $this->messages['en'][] = 'Check the owner of the log file. He must be the same as the web user (usually www-data, www, etc)';
        $this->messages['en'][] = 'Error log is empty or has not been configured correctly. Define the error log file, setting <b>error_log</b> at php.ini';
        $this->messages['en'][] = 'Errors are not being logged. Please turn <b>log_errors = On</b> at php.ini';
        $this->messages['en'][] = 'Errors are not currently being displayd because the <b>display_errors</b> is set to Off in php.ini';
        $this->messages['en'][] = 'This configuration is usually recommended for production, not development purposes';
        $this->messages['en'][] = 'The php.ini current location is <b>^1</b>';
        $this->messages['en'][] = 'The error log current location is <b>^1</b>';
        $this->messages['en'][] = 'PHP Log';
        $this->messages['en'][] = 'Database explorer';
        $this->messages['en'][] = 'Tables';
        $this->messages['en'][] = 'Report generated. Please, enable popups';
        $this->messages['en'][] = 'File saved';
        $this->messages['en'][] = 'Edit page';
        $this->messages['en'][] = 'Update page';
        $this->messages['en'][] = 'Module';
        $this->messages['en'][] = 'Directory';
        $this->messages['en'][] = 'Source code';
        $this->messages['en'][] = 'Invalid return';
        $this->messages['en'][] = 'Page';
        $this->messages['en'][] = 'Connection failed';
        $this->messages['en'][] = 'Summary database install';
        $this->messages['en'][] = 'No write permission on file';
        $this->messages['en'][] = 'In order to continue with the installation you must grant read permission to the directory';
        $this->messages['en'][] = 'In order to continue with the installation you must grant write permission to the directory';
        $this->messages['en'][] = 'Installed';
        $this->messages['en'][] = 'Path';
        $this->messages['en'][] = 'File';
        $this->messages['en'][] = 'Write';
        $this->messages['en'][] = 'Read';
        $this->messages['en'][] = 'In order to continue with the installation you must grant read permission to the file';
        $this->messages['en'][] = 'In order to continue with the installation you must grant write permission to the file';
        $this->messages['en'][] = 'Photo';
        $this->messages['en'][] = 'Reset password';
        $this->messages['en'][] = 'A new seed is required in the application.ini for security reasons';
        $this->messages['en'][] = 'Password reset';
        $this->messages['en'][] = 'Token expired. This operation is not allowed';
        $this->messages['en'][] = 'The password has been changed';
        $this->messages['en'][] = 'An user with this e-mail is already registered';
        $this->messages['en'][] = 'Invalid LDAP credentials';
        $this->messages['en'][] = 'Update menu overwriting existing file?';
        $this->messages['en'][] = 'Menu updated successfully';
        $this->messages['en'][] = 'Menu path';
        $this->messages['en'][] = 'Add to menu';
        $this->messages['en'][] = 'Remove from menu';
        $this->messages['en'][] = 'Item removed from menu';
        $this->messages['en'][] = 'Item added to menu';
        $this->messages['en'][] = 'Icon';
        $this->messages['en'][] = 'User registration';
        $this->messages['en'][] = 'The user registration is disabled';
        $this->messages['en'][] = 'The password reset is disabled';
        $this->messages['en'][] = 'Account created';
        $this->messages['en'][] = 'Create account';
        $this->messages['en'][] = 'If you want to reinstall edit the file app/config/install.ini and change installed = 1 to installed = 0. Erase the content in app/config/installed.ini too';
        $this->messages['en'][] = 'Authorization error';
        $this->messages['en'][] = 'Exit';
        $this->messages['en'][] = 'REST key not defined';
        $this->messages['en'][] = 'Local';
        $this->messages['en'][] = 'Remote';
        $this->messages['en'][] = 'Success';
        $this->messages['en'][] = 'Error';
        $this->messages['en'][] = 'Status';
        $this->messages['en'][] = 'Update permissions?';
        $this->messages['en'][] = 'Changed';
        $this->messages['en'][] = 'CPF';
        $this->messages['en'][] = 'Cell Phone';

        $this->messages['pt'][] = 'Arquivo n??o encontrado';
        $this->messages['pt'][] = 'Pesquisar';
        $this->messages['pt'][] = 'Cadastrar';
        $this->messages['pt'][] = 'Registro salvo';
        $this->messages['pt'][] = 'Deseja realmente excluir ?';
        $this->messages['pt'][] = 'Registro exclu??do';
        $this->messages['pt'][] = 'Fun????o';
        $this->messages['pt'][] = 'Tabela';
        $this->messages['pt'][] = 'Ferramenta';
        $this->messages['pt'][] = 'Dados';
        $this->messages['pt'][] = 'Abrir';
        $this->messages['pt'][] = 'Novo';
        $this->messages['pt'][] = 'Salvar';
        $this->messages['pt'][] = 'Pesquisar';
        $this->messages['pt'][] = 'Editar';
        $this->messages['pt'][] = 'Excluir';
        $this->messages['pt'][] = 'Cancelar';
        $this->messages['pt'][] = 'Sim';
        $this->messages['pt'][] = 'N??o';
        $this->messages['pt'][] = 'Janeiro';
        $this->messages['pt'][] = 'Fevereiro';
        $this->messages['pt'][] = 'Mar??o';
        $this->messages['pt'][] = 'Abril';
        $this->messages['pt'][] = 'Maio';
        $this->messages['pt'][] = 'Junho';
        $this->messages['pt'][] = 'Julho';
        $this->messages['pt'][] = 'Agosto';
        $this->messages['pt'][] = 'Setembro';
        $this->messages['pt'][] = 'Outubro';
        $this->messages['pt'][] = 'Novembro';
        $this->messages['pt'][] = 'Dezembro';
        $this->messages['pt'][] = 'Hoje';
        $this->messages['pt'][] = 'Fechar';
        $this->messages['pt'][] = 'O campo ^1 n??o pode ter menos de ^2 caracteres';
        $this->messages['pt'][] = 'O campo ^1 n??o pode ter mais de ^2 caracteres';
        $this->messages['pt'][] = 'O campo ^1 n??o pode ser menor que ^2';
        $this->messages['pt'][] = 'O campo ^1 n??o pode ser maior que ^2';
        $this->messages['pt'][] = 'O campo ^1 ?? obrigat??rio';
        $this->messages['pt'][] = 'O campo ^1 n??o cont??m um CNPJ v??lido';
        $this->messages['pt'][] = 'O campo ^1 n??o cont??m um CPF v??lido';
        $this->messages['pt'][] = 'O campo ^1 cont??m um e-mail inv??lido';
        $this->messages['pt'][] = 'Permiss??o negada';
        $this->messages['pt'][] = 'Gerar';
        $this->messages['pt'][] = 'Listar';
        $this->messages['pt'][] = 'Senha errada';
        $this->messages['pt'][] = 'Usu??rio n??o encontrado';
        $this->messages['pt'][] = 'Usu??rio';
        $this->messages['pt'][] = 'Usu??rios';
        $this->messages['pt'][] = 'Senha';
        $this->messages['pt'][] = 'Usu??rio';
        $this->messages['pt'][] = 'Nome';
        $this->messages['pt'][] = 'Grupo';
        $this->messages['pt'][] = 'Grupos';
        $this->messages['pt'][] = 'Programa';
        $this->messages['pt'][] = 'Programas';
        $this->messages['pt'][] = 'Voltar para a listagem';
        $this->messages['pt'][] = 'Classe de controle';
        $this->messages['pt'][] = 'Email';
        $this->messages['pt'][] = 'Registro atualizado';
        $this->messages['pt'][] = 'Confirma senha';
        $this->messages['pt'][] = 'Tela inicial';
        $this->messages['pt'][] = 'Nome da Tela';
        $this->messages['pt'][] = 'As senhas n??o conferem';
        $this->messages['pt'][] = 'Entrar';
        $this->messages['pt'][] = 'Data';
        $this->messages['pt'][] = 'Coluna';
        $this->messages['pt'][] = 'Opera????o';
        $this->messages['pt'][] = 'Valor antigo';
        $this->messages['pt'][] = 'Valor novo';
        $this->messages['pt'][] = 'Banco de dados';
        $this->messages['pt'][] = 'Perfil';
        $this->messages['pt'][] = 'Mudar senha';
        $this->messages['pt'][] = 'Deixe vazio para manter a senha anterior';
        $this->messages['pt'][] = 'Resultados';
        $this->messages['pt'][] = 'Comando inv??lido';
        $this->messages['pt'][] = '^1 registros exibidos';
        $this->messages['pt'][] = 'Administra????o';
        $this->messages['pt'][] = 'Painel SQL';
        $this->messages['pt'][] = 'Log de acesso';
        $this->messages['pt'][] = 'Log de altera????es';
        $this->messages['pt'][] = 'Log de SQL';
        $this->messages['pt'][] = 'Limpar formul??rio';
        $this->messages['pt'][] = 'Enviar';
        $this->messages['pt'][] = 'Mensagem';
        $this->messages['pt'][] = 'Mensagens';
        $this->messages['pt'][] = 'Assunto';
        $this->messages['pt'][] = 'Mensagem enviada com sucesso';
        $this->messages['pt'][] = 'Marcar como lida';
        $this->messages['pt'][] = 'Marcar como n??o lida';
        $this->messages['pt'][] = 'A????o';
        $this->messages['pt'][] = 'Ler';
        $this->messages['pt'][] = 'Origem';
        $this->messages['pt'][] = 'Verificado';
        $this->messages['pt'][] = 'Objeto ^1 n??o encontrado em ^2';
        $this->messages['pt'][] = 'Notifica????o';
        $this->messages['pt'][] = 'Notifica????es';
        $this->messages['pt'][] = 'Categorias';
        $this->messages['pt'][] = 'Enviar documentos';
        $this->messages['pt'][] = 'Meus documentos';
        $this->messages['pt'][] = 'Compartilhados comigo';
        $this->messages['pt'][] = 'Documento';
        $this->messages['pt'][] = 'Arquivo';
        $this->messages['pt'][] = 'T??tulo';
        $this->messages['pt'][] = 'Descri????o';
        $this->messages['pt'][] = 'Categoria';
        $this->messages['pt'][] = 'Data de submiss??o';
        $this->messages['pt'][] = 'Data de arquivamento';
        $this->messages['pt'][] = 'Upload';
        $this->messages['pt'][] = 'Download';
        $this->messages['pt'][] = 'Pr??ximo';
        $this->messages['pt'][] = 'Documentos';
        $this->messages['pt'][] = 'Permiss??o';
        $this->messages['pt'][] = 'Unidade';
        $this->messages['pt'][] = 'Unidades';
        $this->messages['pt'][] = 'Adiciona';
        $this->messages['pt'][] = 'Ativo';
        $this->messages['pt'][] = 'Ativar/desativar';
        $this->messages['pt'][] = 'Usu??rio inativo';
        $this->messages['pt'][] = 'Envia mensagem';
        $this->messages['pt'][] = 'Ler mensagens';
        $this->messages['pt'][] = 'J?? existe um cadastro com este usu??rio';
        $this->messages['pt'][] = 'Estat??sticas de acesso';
        $this->messages['pt'][] = 'Acessos';
        $this->messages['pt'][] = 'Prefer??ncias';
        $this->messages['pt'][] = 'E-mail de origem';
        $this->messages['pt'][] = 'Autentica SMTP';
        $this->messages['pt'][] = 'Host SMTP';
        $this->messages['pt'][] = 'Porta SMTP';
        $this->messages['pt'][] = 'Usu??rio SMTP';
        $this->messages['pt'][] = 'Senha SMTP';
        $this->messages['pt'][] = 'Ticket';
        $this->messages['pt'][] = 'Abrir ticket';
        $this->messages['pt'][] = 'Email de suporte';
        $this->messages['pt'][] = 'Dia';
        $this->messages['pt'][] = 'Pastas';
        $this->messages['pt'][] = 'Compor';
        $this->messages['pt'][] = 'Entrada';
        $this->messages['pt'][] = 'Enviados';
        $this->messages['pt'][] = 'Arquivados';
        $this->messages['pt'][] = 'Arquivar';
        $this->messages['pt'][] = 'Recuperar';
        $this->messages['pt'][] = 'Valor';
        $this->messages['pt'][] = 'Ver todos';
        $this->messages['pt'][] = 'Recarregar';
        $this->messages['pt'][] = 'Voltar';
        $this->messages['pt'][] = 'Limpar';
        $this->messages['pt'][] = 'Visualizar';
        $this->messages['pt'][] = 'Nenhum registro foi encontrado';
        $this->messages['pt'][] = 'Desenho gerado com sucesso';
        $this->messages['pt'][] = 'QR codes gerados com sucesso';
        $this->messages['pt'][] = 'C??digos de barra gerados com sucesso';
        $this->messages['pt'][] = 'Documento gerado com sucesso';
        $this->messages['pt'][] = 'Valor';
        $this->messages['pt'][] = 'Usu??rio';
        $this->messages['pt'][] = 'Senha';
        $this->messages['pt'][] = 'Porta';
        $this->messages['pt'][] = 'Tipo da base de dados';
        $this->messages['pt'][] = 'Usu??rio admin';
        $this->messages['pt'][] = 'Senha do usu??rio admin';
        $this->messages['pt'][] = 'Criar base de dados/usu??rio';
        $this->messages['pt'][] = 'Testar conex??o';
        $this->messages['pt'][] = 'Nome da base de dados';
        $this->messages['pt'][] = 'Inserir permiss??es/programas';
        $this->messages['pt'][] = 'Base de dados e usu??rio criado com sucesso';
        $this->messages['pt'][] = 'Permiss??es e programas inseridos com sucesso';
        $this->messages['pt'][] = 'Atualizar config';
        $this->messages['pt'][] = 'Arquivo de configura????o: ^1 atualizado com sucesso';
        $this->messages['pt'][] = 'Conex??o realizada com sucesso';
        $this->messages['pt'][] = 'A base de dados ^1 n??o existe';
        $this->messages['pt'][] = 'Permiss??es/programas inseridos com sucesso';
        $this->messages['pt'][] = 'Os programas/permiss??es j?? foram inseridos';
        $this->messages['pt'][] = 'Instalando a sua aplica????o';
        $this->messages['pt'][] = 'Verifica????o da vers??o do PHP e extens??es instaladas';
        $this->messages['pt'][] = 'Verifica????o do PHP';
        $this->messages['pt'][] = 'Verifica????o de diret??rios e arquivos';
        $this->messages['pt'][] = 'Configura????o/cria????o de base de dados';
        $this->messages['pt'][] = 'Usu??rio admin';
        $this->messages['pt'][] = 'Senha do usu??rio admin';
        $this->messages['pt'][] = 'Inserir dados';
        $this->messages['pt'][] = 'Da base de dados:';
        $this->messages['pt'][] = 'A conex??o com a base de dados ^1 falhou';
        $this->messages['pt'][] = 'Instalar';
        $this->messages['pt'][] = 'Bases de dados instaladas com sucesso';
        $this->messages['pt'][] = 'As bases de dados j?? foram instaladas';
        $this->messages['pt'][] = 'Unidade principal';
        $this->messages['pt'][] = 'Hora';
        $this->messages['pt'][] = 'Tipo';
        $this->messages['pt'][] = 'Falha ao ler o log de erros (^1)';
        $this->messages['pt'][] = 'O log de erros (^1) n??o permite escrita pelo usu??rio web, assim as mensagens devem estar incompletas';
        $this->messages['pt'][] = 'Revise o propriet??rio do arquivo de log. Ele deve ser igual ao usu??rio web (geralmente www-data, www, etc)';
        $this->messages['pt'][] = 'Log de erros est?? vazio ou n??o foi configurado corretamente. Defina o arquivo de log de erros, configurando <b>error_log</b> no php.ini';
        $this->messages['pt'][] = 'Erros n??o est??o sendo registrados. Por favor, mude <b>log_errors = On</b> no php.ini';
        $this->messages['pt'][] = 'Erros n??o est??o atualmente sendo exibidos por que <b>display_errors</b> est?? configurado para Off no php.ini';
        $this->messages['pt'][] = 'Esta configura????o normalmente ?? recomendada para produ????o, n??o para o prop??sito de desenvolvimento';
        $this->messages['pt'][] = 'A localiza????o atual do php.ini ?? <b>^1</b>';
        $this->messages['pt'][] = 'A localiza????o atual do log de erros ?? <b>^1</b>';
        $this->messages['pt'][] = 'Log do PHP';
        $this->messages['pt'][] = 'Database explorer';
        $this->messages['pt'][] = 'Tabelas';
        $this->messages['pt'][] = 'Relat??rio gerado. Favor, habilitar os popups';
        $this->messages['pt'][] = 'Arquivo salvo';
        $this->messages['pt'][] = 'Editar p??gina';
        $this->messages['pt'][] = 'Atualizar p??gina';
        $this->messages['pt'][] = 'M??dulo';
        $this->messages['pt'][] = 'Diret??rio';
        $this->messages['pt'][] = 'C??digo-fonte';
        $this->messages['pt'][] = 'Retorno inv??lido';
        $this->messages['pt'][] = 'P??gina';
        $this->messages['pt'][] = 'Falhas na conex??o';
        $this->messages['pt'][] = 'Resumo da instala????o da base de dados';
        $this->messages['pt'][] = 'Sem permiss??o de escrita no arquivo';
        $this->messages['pt'][] = 'Para que seja poss??vel continuar com a instala????o voc?? deve conceder permiss??o de leitura para o diret??rio';
        $this->messages['pt'][] = 'Para que seja poss??vel continuar com a instala????o voc?? deve conceder permiss??o de escrita para o diret??rio';
        $this->messages['pt'][] = 'Instalada';
        $this->messages['pt'][] = 'Diret??rio';
        $this->messages['pt'][] = 'Arquivo';
        $this->messages['pt'][] = 'Escrita';
        $this->messages['pt'][] = 'Leitura';
        $this->messages['pt'][] = 'Para que seja poss??vel continuar com a instala????o voc?? deve conceder permiss??o de leitura para o arquivo';
        $this->messages['pt'][] = 'Para que seja poss??vel continuar com a instala????o voc?? deve conceder permiss??o de escrita para o arquivo';
        $this->messages['pt'][] = 'Foto';
        $this->messages['pt'][] = 'Redefinir senha';
        $this->messages['pt'][] = 'Uma nova seed ?? necess??ria no application.ini por motivos de seguran??a';
        $this->messages['pt'][] = 'Troca de senha';
        $this->messages['pt'][] = 'Token expirado. Esta opera????o n??o ?? permitida';
        $this->messages['pt'][] = 'A senha foi alterada';
        $this->messages['pt'][] = 'Um usu??rio j?? est?? cadastrado com este e-mail';
        $this->messages['pt'][] = 'Credenciais LDAP erradas';
        $this->messages['pt'][] = 'Atualizar o menu sobregravando arquivo existente?';
        $this->messages['pt'][] = 'Menu atualizado com sucesso';
        $this->messages['pt'][] = 'Caminho menu';
        $this->messages['pt'][] = 'Adiciona ao menu';
        $this->messages['pt'][] = 'Remove do menu';
        $this->messages['pt'][] = 'Item removido do menu';
        $this->messages['pt'][] = 'Item adicionado ao menu';
        $this->messages['pt'][] = '??cone';
        $this->messages['pt'][] = 'Cadastro de usu??rio';
        $this->messages['pt'][] = 'O cadastro de usu??rios est?? desabilitado';
        $this->messages['pt'][] = 'A recupera????o de senhas est?? desabilitada';
        $this->messages['pt'][] = 'Conta criada';
        $this->messages['pt'][] = 'Criar conta';
        $this->messages['pt'][] = 'Se voc?? deseja reinstalar, edite o arquivo app/config/install.ini e altere installed = 1 para installed = 0. Apague o conte??do no arquivo app/config/install.ini tamb??m';
        $this->messages['pt'][] = 'Erro de autoriza????o';
        $this->messages['pt'][] = 'Sair';
        $this->messages['pt'][] = 'Chave REST n??o definida';
        $this->messages['pt'][] = 'Local';
        $this->messages['pt'][] = 'Remoto';
        $this->messages['pt'][] = 'Sucesso';
        $this->messages['pt'][] = 'Erro';
        $this->messages['pt'][] = 'Status';
        $this->messages['pt'][] = 'Atualiza permiss??es?';
        $this->messages['pt'][] = 'Modificado';
        $this->messages['pt'][] = 'CPF';
        $this->messages['pt'][] = 'Celular';

        $this->messages['pt_pt'][] = 'Arquivo n??o encontrado';
        $this->messages['pt_pt'][] = 'Pesquisar';
        $this->messages['pt_pt'][] = 'Cadastrar';
        $this->messages['pt_pt'][] = 'Registro salvo';
        $this->messages['pt_pt'][] = 'Deseja realmente excluir ?';
        $this->messages['pt_pt'][] = 'Registro exclu??do';
        $this->messages['pt_pt'][] = 'Fun????o';
        $this->messages['pt_pt'][] = 'Tabela';
        $this->messages['pt_pt'][] = 'Ferramenta';
        $this->messages['pt_pt'][] = 'Dados';
        $this->messages['pt_pt'][] = 'Abrir';
        $this->messages['pt_pt'][] = 'Novo';
        $this->messages['pt_pt'][] = 'Salvar';
        $this->messages['pt_pt'][] = 'Pesquisar';
        $this->messages['pt_pt'][] = 'Editar';
        $this->messages['pt_pt'][] = 'Excluir';
        $this->messages['pt_pt'][] = 'Cancelar';
        $this->messages['pt_pt'][] = 'Sim';
        $this->messages['pt_pt'][] = 'N??o';
        $this->messages['pt_pt'][] = 'Janeiro';
        $this->messages['pt_pt'][] = 'Fevereiro';
        $this->messages['pt_pt'][] = 'Mar??o';
        $this->messages['pt_pt'][] = 'Abril';
        $this->messages['pt_pt'][] = 'Maio';
        $this->messages['pt_pt'][] = 'Junho';
        $this->messages['pt_pt'][] = 'Julho';
        $this->messages['pt_pt'][] = 'Agosto';
        $this->messages['pt_pt'][] = 'Setembro';
        $this->messages['pt_pt'][] = 'Outubro';
        $this->messages['pt_pt'][] = 'Novembro';
        $this->messages['pt_pt'][] = 'Dezembro';
        $this->messages['pt_pt'][] = 'Hoje';
        $this->messages['pt_pt'][] = 'Fechar';
        $this->messages['pt_pt'][] = 'O campo ^1 n??o pode ter menos de ^2 caracteres';
        $this->messages['pt_pt'][] = 'O campo ^1 n??o pode ter mais de ^2 caracteres';
        $this->messages['pt_pt'][] = 'O campo ^1 n??o pode ser menor que ^2';
        $this->messages['pt_pt'][] = 'O campo ^1 n??o pode ser maior que ^2';
        $this->messages['pt_pt'][] = 'O campo ^1 ?? obrigat??rio';
        $this->messages['pt_pt'][] = 'O campo ^1 n??o cont??m um CNPJ v??lido';
        $this->messages['pt_pt'][] = 'O campo ^1 n??o cont??m um NIF v??lido';
        $this->messages['pt_pt'][] = 'O campo ^1 cont??m um e-mail inv??lido';
        $this->messages['pt_pt'][] = 'Permiss??o negada';
        $this->messages['pt_pt'][] = 'Gerar';
        $this->messages['pt_pt'][] = 'Listar';
        $this->messages['pt_pt'][] = 'Palavra passe errada';
        $this->messages['pt_pt'][] = 'Usu??rio n??o encontrado';
        $this->messages['pt_pt'][] = 'Usu??rio';
        $this->messages['pt_pt'][] = 'Usu??rios';
        $this->messages['pt_pt'][] = 'Palavra passe';
        $this->messages['pt_pt'][] = 'Usu??rio';
        $this->messages['pt_pt'][] = 'Nome';
        $this->messages['pt_pt'][] = 'Grupo';
        $this->messages['pt_pt'][] = 'Grupos';
        $this->messages['pt_pt'][] = 'Programa';
        $this->messages['pt_pt'][] = 'Programas';
        $this->messages['pt_pt'][] = 'Voltar para a listagem';
        $this->messages['pt_pt'][] = 'Classe de controle';
        $this->messages['pt_pt'][] = 'Email';
        $this->messages['pt_pt'][] = 'Registro atualizado';
        $this->messages['pt_pt'][] = 'Confirma Palavra passe';
        $this->messages['pt_pt'][] = 'Tela inicial';
        $this->messages['pt_pt'][] = 'Nome da Tela';
        $this->messages['pt_pt'][] = 'As Palavra passes n??o conferem';
        $this->messages['pt_pt'][] = 'Entrar';
        $this->messages['pt_pt'][] = 'Data';
        $this->messages['pt_pt'][] = 'Coluna';
        $this->messages['pt_pt'][] = 'Opera????o';
        $this->messages['pt_pt'][] = 'Valor antigo';
        $this->messages['pt_pt'][] = 'Valor novo';
        $this->messages['pt_pt'][] = 'Banco de dados';
        $this->messages['pt_pt'][] = 'Perfil';
        $this->messages['pt_pt'][] = 'Mudar Palavra passe';
        $this->messages['pt_pt'][] = 'Deixe vazio para manter a Palavra passe anterior';
        $this->messages['pt_pt'][] = 'Resultados';
        $this->messages['pt_pt'][] = 'Comando inv??lido';
        $this->messages['pt_pt'][] = '^1 registros exibidos';
        $this->messages['pt_pt'][] = 'Administra????o';
        $this->messages['pt_pt'][] = 'Painel SQL';
        $this->messages['pt_pt'][] = 'Log de acesso';
        $this->messages['pt_pt'][] = 'Log de altera????es';
        $this->messages['pt_pt'][] = 'Log de SQL';
        $this->messages['pt_pt'][] = 'Limpar formul??rio';
        $this->messages['pt_pt'][] = 'Enviar';
        $this->messages['pt_pt'][] = 'Mensagem';
        $this->messages['pt_pt'][] = 'Mensagens';
        $this->messages['pt_pt'][] = 'Assunto';
        $this->messages['pt_pt'][] = 'Mensagem enviada com sucesso';
        $this->messages['pt_pt'][] = 'Marcar como lida';
        $this->messages['pt_pt'][] = 'Marcar como n??o lida';
        $this->messages['pt_pt'][] = 'A????o';
        $this->messages['pt_pt'][] = 'Ler';
        $this->messages['pt_pt'][] = 'Origem';
        $this->messages['pt_pt'][] = 'Verificado';
        $this->messages['pt_pt'][] = 'Objeto ^1 n??o encontrado em ^2';
        $this->messages['pt_pt'][] = 'Notifica????o';
        $this->messages['pt_pt'][] = 'Notifica????es';
        $this->messages['pt_pt'][] = 'Categorias';
        $this->messages['pt_pt'][] = 'Enviar documentos';
        $this->messages['pt_pt'][] = 'Meus documentos';
        $this->messages['pt_pt'][] = 'Compartilhados comigo';
        $this->messages['pt_pt'][] = 'Documento';
        $this->messages['pt_pt'][] = 'Arquivo';
        $this->messages['pt_pt'][] = 'T??tulo';
        $this->messages['pt_pt'][] = 'Descri????o';
        $this->messages['pt_pt'][] = 'Categoria';
        $this->messages['pt_pt'][] = 'Data de submiss??o';
        $this->messages['pt_pt'][] = 'Data de arquivamento';
        $this->messages['pt_pt'][] = 'Upload';
        $this->messages['pt_pt'][] = 'Download';
        $this->messages['pt_pt'][] = 'Pr??ximo';
        $this->messages['pt_pt'][] = 'Documentos';
        $this->messages['pt_pt'][] = 'Permiss??o';
        $this->messages['pt_pt'][] = 'Unidade';
        $this->messages['pt_pt'][] = 'Unidades';
        $this->messages['pt_pt'][] = 'Adiciona';
        $this->messages['pt_pt'][] = 'Ativo';
        $this->messages['pt_pt'][] = 'Ativar/desativar';
        $this->messages['pt_pt'][] = 'Usu??rio inativo';
        $this->messages['pt_pt'][] = 'Envia mensagem';
        $this->messages['pt_pt'][] = 'Ler mensagens';
        $this->messages['pt_pt'][] = 'J?? existe um cadastro com este usu??rio';
        $this->messages['pt_pt'][] = 'Estat??sticas de acesso';
        $this->messages['pt_pt'][] = 'Acessos';
        $this->messages['pt_pt'][] = 'Prefer??ncias';
        $this->messages['pt_pt'][] = 'E-mail de origem';
        $this->messages['pt_pt'][] = 'Autentica SMTP';
        $this->messages['pt_pt'][] = 'Host SMTP';
        $this->messages['pt_pt'][] = 'Porta SMTP';
        $this->messages['pt_pt'][] = 'Usu??rio SMTP';
        $this->messages['pt_pt'][] = 'Palavra passe SMTP';
        $this->messages['pt_pt'][] = 'Ticket';
        $this->messages['pt_pt'][] = 'Abrir ticket';
        $this->messages['pt_pt'][] = 'Email de suporte';
        $this->messages['pt_pt'][] = 'Dia';
        $this->messages['pt_pt'][] = 'Pastas';
        $this->messages['pt_pt'][] = 'Compor';
        $this->messages['pt_pt'][] = 'Entrada';
        $this->messages['pt_pt'][] = 'Enviados';
        $this->messages['pt_pt'][] = 'Arquivados';
        $this->messages['pt_pt'][] = 'Arquivar';
        $this->messages['pt_pt'][] = 'Recuperar';
        $this->messages['pt_pt'][] = 'Valor';
        $this->messages['pt_pt'][] = 'Ver todos';
        $this->messages['pt_pt'][] = 'Recarregar';
        $this->messages['pt_pt'][] = 'Voltar';
        $this->messages['pt_pt'][] = 'Limpar';
        $this->messages['pt_pt'][] = 'Visualizar';
        $this->messages['pt_pt'][] = 'Nenhum registro foi encontrado';
        $this->messages['pt_pt'][] = 'Desenho gerado com sucesso';
        $this->messages['pt_pt'][] = 'QR codes gerados com sucesso';
        $this->messages['pt_pt'][] = 'C??digos de barra gerados com sucesso';
        $this->messages['pt_pt'][] = 'Documento gerado com sucesso';
        $this->messages['pt_pt'][] = 'Valor';
        $this->messages['pt_pt'][] = 'Usu??rio';
        $this->messages['pt_pt'][] = 'Palavra passe';
        $this->messages['pt_pt'][] = 'Porta';
        $this->messages['pt_pt'][] = 'Tipo da base de dados';
        $this->messages['pt_pt'][] = 'Usu??rio admin';
        $this->messages['pt_pt'][] = 'Palavra passe do usu??rio admin';
        $this->messages['pt_pt'][] = 'Criar base de dados/usu??rio';
        $this->messages['pt_pt'][] = 'Testar conex??o';
        $this->messages['pt_pt'][] = 'Nome da base de dados';
        $this->messages['pt_pt'][] = 'Inserir permiss??es/programas';
        $this->messages['pt_pt'][] = 'Base de dados e usu??rio criado com sucesso';
        $this->messages['pt_pt'][] = 'Permiss??es e programas inseridos com sucesso';
        $this->messages['pt_pt'][] = 'Atualizar config';
        $this->messages['pt_pt'][] = 'Arquivo de configura????o: ^1 atualizado com sucesso';
        $this->messages['pt_pt'][] = 'Conex??o realizada com sucesso';
        $this->messages['pt_pt'][] = 'A base de dados ^1 n??o existe';
        $this->messages['pt_pt'][] = 'Permiss??es/programas inseridos com sucesso';
        $this->messages['pt_pt'][] = 'Os programas/permiss??es j?? foram inseridos';
        $this->messages['pt_pt'][] = 'Instalando a sua aplica????o';
        $this->messages['pt_pt'][] = 'Verifica????o da vers??o do PHP e extens??es instaladas';
        $this->messages['pt_pt'][] = 'Verifica????o do PHP';
        $this->messages['pt_pt'][] = 'Verifica????o de diret??rios e arquivos';
        $this->messages['pt_pt'][] = 'Configura????o/cria????o de base de dados';
        $this->messages['pt_pt'][] = 'Usu??rio admin';
        $this->messages['pt_pt'][] = 'Palavra passe do usu??rio admin';
        $this->messages['pt_pt'][] = 'Inserir dados';
        $this->messages['pt_pt'][] = 'Da base de dados:';
        $this->messages['pt_pt'][] = 'A conex??o com a base de dados ^1 falhou';
        $this->messages['pt_pt'][] = 'Instalar';
        $this->messages['pt_pt'][] = 'Bases de dados instaladas com sucesso';
        $this->messages['pt_pt'][] = 'As bases de dados j?? foram instaladas';
        $this->messages['pt_pt'][] = 'Unidade principal';
        $this->messages['pt_pt'][] = 'Hora';
        $this->messages['pt_pt'][] = 'Tipo';
        $this->messages['pt_pt'][] = 'Falha ao ler o log de erros (^1)';
        $this->messages['pt_pt'][] = 'O log de erros (^1) n??o permite escrita pelo usu??rio web, assim as mensagens devem estar incompletas';
        $this->messages['pt_pt'][] = 'Revise o propriet??rio do arquivo de log. Ele deve ser igual ao usu??rio web (geralmente www-data, www, etc)';
        $this->messages['pt_pt'][] = 'Log de erros est?? vazio ou n??o foi configurado corretamente. Defina o arquivo de log de erros, configurando <b>error_log</b> no php.ini';
        $this->messages['pt_pt'][] = 'Erros n??o est??o sendo registrados. Por favor, mude <b>log_errors = On</b> no php.ini';
        $this->messages['pt_pt'][] = 'Erros n??o est??o atualmente sendo exibidos por que <b>display_errors</b> est?? configurado para Off no php.ini';
        $this->messages['pt_pt'][] = 'Esta configura????o normalmente ?? recomendada para produ????o, n??o para o prop??sito de desenvolvimento';
        $this->messages['pt_pt'][] = 'A localiza????o atual do php.ini ?? <b>^1</b>';
        $this->messages['pt_pt'][] = 'A localiza????o atual do log de erros ?? <b>^1</b>';
        $this->messages['pt_pt'][] = 'Log do PHP';
        $this->messages['pt_pt'][] = 'Database explorer';
        $this->messages['pt_pt'][] = 'Tabelas';
        $this->messages['pt_pt'][] = 'Relat??rio gerado. Favor, habilitar os popups';
        $this->messages['pt_pt'][] = 'Arquivo salvo';
        $this->messages['pt_pt'][] = 'Editar p??gina';
        $this->messages['pt_pt'][] = 'Atualizar p??gina';
        $this->messages['pt_pt'][] = 'M??dulo';
        $this->messages['pt_pt'][] = 'Diret??rio';
        $this->messages['pt_pt'][] = 'C??digo-fonte';
        $this->messages['pt_pt'][] = 'Retorno inv??lido';
        $this->messages['pt_pt'][] = 'P??gina';
        $this->messages['pt_pt'][] = 'Falhas na conex??o';
        $this->messages['pt_pt'][] = 'Resumo da instala????o da base de dados';
        $this->messages['pt_pt'][] = 'Sem permiss??o de escrita no arquivo';
        $this->messages['pt_pt'][] = 'Para que seja poss??vel continuar com a instala????o voc?? deve conceder permiss??o de leitura para o diret??rio';
        $this->messages['pt_pt'][] = 'Para que seja poss??vel continuar com a instala????o voc?? deve conceder permiss??o de escrita para o diret??rio';
        $this->messages['pt_pt'][] = 'Instalada';
        $this->messages['pt_pt'][] = 'Diret??rio';
        $this->messages['pt_pt'][] = 'Arquivo';
        $this->messages['pt_pt'][] = 'Escrita';
        $this->messages['pt_pt'][] = 'Leitura';
        $this->messages['pt_pt'][] = 'Para que seja poss??vel continuar com a instala????o voc?? deve conceder permiss??o de leitura para o arquivo';
        $this->messages['pt_pt'][] = 'Para que seja poss??vel continuar com a instala????o voc?? deve conceder permiss??o de escrita para o arquivo';
        $this->messages['pt_pt'][] = 'Foto';
        $this->messages['pt_pt'][] = 'Redefinir Palavra passe';
        $this->messages['pt_pt'][] = 'Uma nova seed ?? necess??ria no application.ini por motivos de seguran??a';
        $this->messages['pt_pt'][] = 'Troca de Palavra passe';
        $this->messages['pt_pt'][] = 'Token expirado. Esta opera????o n??o ?? permitida';
        $this->messages['pt_pt'][] = 'A Palavra passe foi alterada';
        $this->messages['pt_pt'][] = 'Um usu??rio j?? est?? cadastrado com este e-mail';
        $this->messages['pt_pt'][] = 'Credenciais LDAP erradas';
        $this->messages['pt_pt'][] = 'Atualizar o menu sobregravando arquivo existente?';
        $this->messages['pt_pt'][] = 'Menu atualizado com sucesso';
        $this->messages['pt_pt'][] = 'Caminho menu';
        $this->messages['pt_pt'][] = 'Adiciona ao menu';
        $this->messages['pt_pt'][] = 'Remove do menu';
        $this->messages['pt_pt'][] = 'Item removido do menu';
        $this->messages['pt_pt'][] = 'Item adicionado ao menu';
        $this->messages['pt_pt'][] = '??cone';
        $this->messages['pt_pt'][] = 'Cadastro de usu??rio';
        $this->messages['pt_pt'][] = 'O cadastro de usu??rios est?? desabilitado';
        $this->messages['pt_pt'][] = 'A recupera????o de Palavra passes est?? desabilitada';
        $this->messages['pt_pt'][] = 'Conta criada';
        $this->messages['pt_pt'][] = 'Criar conta';
        $this->messages['pt_pt'][] = 'Se voc?? deseja reinstalar, edite o arquivo app/config/install.ini e altere installed = 1 para installed = 0. Apague o conte??do no arquivo app/config/install.ini tamb??m';
        $this->messages['pt_pt'][] = 'Erro de autoriza????o';
        $this->messages['pt_pt'][] = 'Sair';
        $this->messages['pt_pt'][] = 'Chave REST n??o definida';
        $this->messages['pt_pt'][] = 'Local';
        $this->messages['pt_pt'][] = 'Remoto';
        $this->messages['pt_pt'][] = 'Sucesso';
        $this->messages['pt_pt'][] = 'Erro';
        $this->messages['pt_pt'][] = 'Status';
        $this->messages['pt_pt'][] = 'Atualiza permiss??es?';
        $this->messages['pt_pt'][] = 'Modificado';
        $this->messages['pt_pt'][] = 'NIF';
        $this->messages['pt_pt'][] = 'Telem??vel';

        $this->messages['es'][] = 'Archivo no encontrado';
        $this->messages['es'][] = 'Buscar';
        $this->messages['es'][] = 'Registrar';
        $this->messages['es'][] = 'Registro guardado';
        $this->messages['es'][] = 'Deseas realmente eliminar ?';
        $this->messages['es'][] = 'Registro eliminado';
        $this->messages['es'][] = 'Funci??n';
        $this->messages['es'][] = 'Tabla';
        $this->messages['es'][] = 'Herramienta';
        $this->messages['es'][] = 'Datos';
        $this->messages['es'][] = 'Abrir';
        $this->messages['es'][] = 'Nuevo';
        $this->messages['es'][] = 'Guardar';
        $this->messages['es'][] = 'Buscar';
        $this->messages['es'][] = 'Modificar';
        $this->messages['es'][] = 'Eliminar';
        $this->messages['es'][] = 'Cancelar';
        $this->messages['es'][] = 'S??';
        $this->messages['es'][] = 'No';
        $this->messages['es'][] = 'Enero';
        $this->messages['es'][] = 'Febrero';
        $this->messages['es'][] = 'Marzo';
        $this->messages['es'][] = 'Abril';
        $this->messages['es'][] = 'Mayo';
        $this->messages['es'][] = 'Junio';
        $this->messages['es'][] = 'Julio';
        $this->messages['es'][] = 'Agosto';
        $this->messages['es'][] = 'Septiembre';
        $this->messages['es'][] = 'Octubre';
        $this->messages['es'][] = 'Noviembre';
        $this->messages['es'][] = 'Diciembre';
        $this->messages['es'][] = 'Hoy';
        $this->messages['es'][] = 'Cerrar';
        $this->messages['es'][] = 'El campo ^1 no puede tener menos de ^2 caracteres';
        $this->messages['es'][] = 'El campo ^1 no puede tener mas de ^2 caracteres';
        $this->messages['es'][] = 'El campo ^1 no puede ser menor que ^2';
        $this->messages['es'][] = 'El campo ^1 no puede ser mayor que ^2';
        $this->messages['es'][] = 'El campo ^1 es obligatorio';
        $this->messages['es'][] = 'El campo ^1 no contiene un CNPJ v??lido';
        $this->messages['es'][] = 'El campo ^1 no contiene un CPF v??lido';
        $this->messages['es'][] = 'El campo ^1 contiene um e-mail inv??lido';
        $this->messages['es'][] = 'Permiso denegado';
        $this->messages['es'][] = 'Generar';
        $this->messages['es'][] = 'Listar';
        $this->messages['es'][] = 'Contrase??a incorrecta';
        $this->messages['es'][] = 'Usu??rio no encontrado';
        $this->messages['es'][] = 'Usu??rio';
        $this->messages['es'][] = 'Usu??rios';
        $this->messages['es'][] = 'Contrase??a';
        $this->messages['es'][] = 'Login';
        $this->messages['es'][] = 'Nombre';
        $this->messages['es'][] = 'Grupo';
        $this->messages['es'][] = 'Grupos';
        $this->messages['es'][] = 'Programa';
        $this->messages['es'][] = 'Programas';
        $this->messages['es'][] = 'Volver al listado';
        $this->messages['es'][] = 'Classe de control';
        $this->messages['es'][] = 'Email';
        $this->messages['es'][] = 'Registro actualizado';
        $this->messages['es'][] = 'Confirme contrase??a';
        $this->messages['es'][] = 'Pantalla inicial';
        $this->messages['es'][] = 'Nombre da la Pantalla';
        $this->messages['es'][] = 'Las contrase??as no conciden';
        $this->messages['es'][] = 'Ingresar';
        $this->messages['es'][] = 'Fecha';
        $this->messages['es'][] = 'Columna';
        $this->messages['es'][] = 'Operaci??n';
        $this->messages['es'][] = 'Valor anterior';
        $this->messages['es'][] = 'Valor nuevo';
        $this->messages['es'][] = 'Base de datos';
        $this->messages['es'][] = 'Perfil';
        $this->messages['es'][] = 'Cambiar contrase??a';
        $this->messages['es'][] = 'Deje vacio para mantener la contrase??a anterior';
        $this->messages['es'][] = 'Resultados';
        $this->messages['es'][] = 'Comando inv??lido';
        $this->messages['es'][] = '^1 registros  exhibidos';
        $this->messages['es'][] = 'Administraci??n';
        $this->messages['es'][] = 'Panel SQL';
        $this->messages['es'][] = 'Log de acceso';
        $this->messages['es'][] = 'Log de modificaciones';
        $this->messages['es'][] = 'Log de SQL';
        $this->messages['es'][] = 'Limpiar formul??rio';
        $this->messages['es'][] = 'Enviar';
        $this->messages['es'][] = 'Mensaje';
        $this->messages['es'][] = 'Mensajes';
        $this->messages['es'][] = 'Asunto';
        $this->messages['es'][] = 'Mensaje enviada exitosamente';
        $this->messages['es'][] = 'Marcar como le??da';
        $this->messages['es'][] = 'Marcar como no le??da';
        $this->messages['es'][] = 'Acci??n';
        $this->messages['es'][] = 'Leer';
        $this->messages['es'][] = 'Origen';
        $this->messages['es'][] = 'Verificado';
        $this->messages['es'][] = 'Objeto ^1 no encontrado en ^2';
        $this->messages['es'][] = 'Notificaci??n';
        $this->messages['es'][] = 'Notificaciones';
        $this->messages['es'][] = 'Categorias';
        $this->messages['es'][] = 'Enviar documentos';
        $this->messages['es'][] = 'Mis documentos';
        $this->messages['es'][] = 'Compartidos conmigo';
        $this->messages['es'][] = 'Documento';
        $this->messages['es'][] = 'Archivo';
        $this->messages['es'][] = 'T??tulo';
        $this->messages['es'][] = 'Descripci??n';
        $this->messages['es'][] = 'Categoria';
        $this->messages['es'][] = 'Fecha de envio';
        $this->messages['es'][] = 'Fecha de archivamiento';
        $this->messages['es'][] = 'Upload';
        $this->messages['es'][] = 'Download';
        $this->messages['es'][] = 'Siguiente';
        $this->messages['es'][] = 'Documentos';
        $this->messages['es'][] = 'Permiso';
        $this->messages['es'][] = 'Unidad';
        $this->messages['es'][] = 'Unidades';
        $this->messages['es'][] = 'Agrega';
        $this->messages['es'][] = 'Activo';
        $this->messages['es'][] = 'Activar/desactivar';
        $this->messages['es'][] = 'Usu??rio desactivado';
        $this->messages['es'][] = 'Envia mensaje';
        $this->messages['es'][] = 'Leer mensaje';
        $this->messages['es'][] = 'Un usu??rio ya est?? registrado con este login';
        $this->messages['es'][] = 'Estadisticas de acceso';
        $this->messages['es'][] = 'Accesos';
        $this->messages['es'][] = 'Preferencias';
        $this->messages['es'][] = 'E-mail de origen';
        $this->messages['es'][] = 'Autentica SMTP';
        $this->messages['es'][] = 'Host SMTP';
        $this->messages['es'][] = 'Puerta SMTP';
        $this->messages['es'][] = 'Usu??rio SMTP';
        $this->messages['es'][] = 'Contrase??a SMTP';
        $this->messages['es'][] = 'Ticket';
        $this->messages['es'][] = 'Abrir ticket';
        $this->messages['es'][] = 'Email de soporte';
        $this->messages['es'][] = 'Dia';
        $this->messages['es'][] = 'Carpetas';
        $this->messages['es'][] = 'Componer';
        $this->messages['es'][] = 'Entrada';
        $this->messages['es'][] = 'Enviados';
        $this->messages['es'][] = 'Archivados';
        $this->messages['es'][] = 'Archivar';
        $this->messages['es'][] = 'Recuperar';
        $this->messages['es'][] = 'Valor';
        $this->messages['es'][] = 'Ver todos';
        $this->messages['es'][] = 'Recargar';
        $this->messages['es'][] = 'Volver';
        $this->messages['es'][] = 'Limpiar';
        $this->messages['es'][] = 'Visualizar';
        $this->messages['es'][] = 'Ningun registro fue encontrado';
        $this->messages['es'][] = 'Dise??o generado con ??xito';
        $this->messages['es'][] = 'QR codes generados con ??xito';
        $this->messages['es'][] = 'C??digos de barra generados con ??xito';
        $this->messages['es'][] = 'Documento generado con ??xito';
        $this->messages['es'][] = 'Valor';
        $this->messages['es'][] = 'Usu??rio';
        $this->messages['es'][] = 'Contrase??a';
        $this->messages['es'][] = 'Puerta';
        $this->messages['es'][] = 'Tipo de base de datos';
        $this->messages['es'][] = 'Usu??rio admin';
        $this->messages['es'][] = 'Contrase??a del usu??rio admin';
        $this->messages['es'][] = 'Crear base de datos/usu??rio';
        $this->messages['es'][] = 'Testear conexi??n';
        $this->messages['es'][] = 'Nombree de la base de datos';
        $this->messages['es'][] = 'Ingresar permisos/programas';
        $this->messages['es'][] = 'Base de datos y usu??rio creado con ??xito';
        $this->messages['es'][] = 'Permisos y programas agregados con ??xito';
        $this->messages['es'][] = 'Actualizar configuraci??n';
        $this->messages['es'][] = 'Archivo de configuraci??n: ^1 actualizado con ??xito';
        $this->messages['es'][] = 'Conexi??n realizada con ??xito';
        $this->messages['es'][] = 'La base de datos ^1 no existe';
        $this->messages['es'][] = 'Permisos/programas agregados con ??xito';
        $this->messages['es'][] = 'Los programas/permisos ya fueron agregados';
        $this->messages['es'][] = 'Instalando en su aplicaci??n';
        $this->messages['es'][] = 'Verficaci??n de la version del PHP y extenciones instaladas';
        $this->messages['es'][] = 'Verficaci??n del PHP';
        $this->messages['es'][] = 'Verficaci??n de directorios y archivos';
        $this->messages['es'][] = 'Configuraci??n/creaci??n de la base de datos';
        $this->messages['es'][] = 'Usu??rio admin';
        $this->messages['es'][] = 'Contrase??a del usu??rio admin';
        $this->messages['es'][] = 'Ingresar datos';
        $this->messages['es'][] = 'De la base de datos:';
        $this->messages['es'][] = 'La conexi??n con la base de datos ^1 fall??';
        $this->messages['es'][] = 'Instalar';
        $this->messages['es'][] = 'Bases de datos instaladas con ??xito';
        $this->messages['es'][] = 'Las bases de datos ya fueron instaladas';
        $this->messages['es'][] = 'Unidad principal';
        $this->messages['es'][] = 'Hora';
        $this->messages['es'][] = 'Tipo';
        $this->messages['es'][] = 'Falla al leer el log de errores (^1)';
        $this->messages['es'][] = 'El log de errores (^1) no permite escritura por el usu??rio web, as?? que los mensajes deben estar incompletos';
        $this->messages['es'][] = 'Revise el propietario del archivo de log. Debe ser igual al usu??rio web (generalmente www-data, www, etc)';
        $this->messages['es'][] = 'Log de errores est?? vacio o no fue configurado correctamente. Defina el archivo de log de errores, configurando <b>error_log</b> en el php.ini';
        $this->messages['es'][] = 'Errores no estan siendo registrados. Por favor, modifique <b>log_errors = On</b> en el php.ini';
        $this->messages['es'][] = 'Errores no estan actualmente siendo mostrados porque <b>display_errors</b> est?? configurado para Off en el php.ini';
        $this->messages['es'][] = 'Esta configuraci??n normalmente es recomendada para producci??n, no para el prop??sito de desarrollo';
        $this->messages['es'][] = 'La ubicaci??n actual del php.ini es <b>^1</b>';
        $this->messages['es'][] = 'La ubicaci??n actual del log de errores es <b>^1</b>';
        $this->messages['es'][] = 'Log del PHP';
        $this->messages['es'][] = 'Database explorer';
        $this->messages['es'][] = 'Tablas';
        $this->messages['es'][] = 'Reporte generado. Favor, habilitar los popups';
        $this->messages['es'][] = 'Archivo guardado';
        $this->messages['es'][] = 'Modificar p??gina';
        $this->messages['es'][] = 'Actualizar p??gina';
        $this->messages['es'][] = 'M??dulo';
        $this->messages['es'][] = 'Direct??rio';
        $this->messages['es'][] = 'C??digo-fuente';
        $this->messages['es'][] = 'Retorno inv??lido';
        $this->messages['es'][] = 'P??gina';
        $this->messages['es'][] = 'Fallas en la conexi??n';
        $this->messages['es'][] = 'Resumen de la instalaci??n de la base de datos';
        $this->messages['es'][] = 'Sin permiso de escritura en el archivo';
        $this->messages['es'][] = 'Para que sea posible continuar con la instalaci??n usted debe conceder permisos de lectura para el direct??rio';
        $this->messages['es'][] = 'Para que sea posible continuar con la instalaci??n usted debe conceder permisos de escritura para el direct??rio';
        $this->messages['es'][] = 'Instalada';
        $this->messages['es'][] = 'Direct??rio';
        $this->messages['es'][] = 'Archivo';
        $this->messages['es'][] = 'Escritura';
        $this->messages['es'][] = 'Lectura';
        $this->messages['es'][] = 'Para que sea posible continuar con la instalaci??n usted debe conceder permisos de lectura para el archivo';
        $this->messages['es'][] = 'Para que sea posible continuar con la instalaci??n usted debe conceder permisos de escritura para el archivo';
        $this->messages['es'][] = 'Foto';
        $this->messages['es'][] = 'Cambiar contrase??a';
        $this->messages['es'][] = 'Una nueva seed es necesaria en application.ini por motivos de seguridad';
        $this->messages['es'][] = 'Cambiar la contrase??a';
        $this->messages['es'][] = 'Token expirado. Esta operaci??n no est?? permitida';
        $this->messages['es'][] = 'La contrase??a fue modificada';
        $this->messages['es'][] = 'Un usu??rio ya est?? registrado con este e-mail';
        $this->messages['es'][] = 'Credenciales LDAP incorrectas';
        $this->messages['es'][] = 'Actualizar el menu reemplazando el archivo existente?';
        $this->messages['es'][] = 'Menu actualizado con ??xito';
        $this->messages['es'][] = 'Direcci??n del menu';
        $this->messages['es'][] = 'Agregar al menu';
        $this->messages['es'][] = 'Eliminar del menu';
        $this->messages['es'][] = 'Iten eliminado del menu';
        $this->messages['es'][] = 'Iten agregado al menu';
        $this->messages['es'][] = '??cono';
        $this->messages['es'][] = 'Registro de usu??rio';
        $this->messages['es'][] = 'El registro de usu??rios est?? desactivado';
        $this->messages['es'][] = 'La recuperaci??n de contrase??a est?? desactivada';
        $this->messages['es'][] = 'Cuenta creada';
        $this->messages['es'][] = 'Crear cuenta';
        $this->messages['es'][] = 'Si desea reinstalar, edite el archivo app/config/install.ini y cambie installed = 1 a installed = 0. Borre el contenido en el archivo app/config/install.ini tambi??n';
        $this->messages['es'][] = 'Error de autorizaci??n';
        $this->messages['es'][] = 'Salir';
        $this->messages['es'][] = 'Clave REST no definida';
        $this->messages['es'][] = 'Local';
        $this->messages['es'][] = 'Remoto';
        $this->messages['es'][] = '??xito';
        $this->messages['es'][] = 'Error';
        $this->messages['es'][] = 'Estado';
        $this->messages['es'][] = 'Actualizar permisos?';
        $this->messages['es'][] = 'Cambiado';
        $this->messages['es'][] = 'RUC';
        $this->messages['es'][] = 'Fone';

        $this->messages['en'][] = 'J?? existe um usu??rio cadastrado com o CPF informado.';
        $this->messages['pt'][] = 'J?? existe um usu??rio cadastrado com o CPF informado.';
        $this->messages['es'][] = 'J?? existe um usu??rio cadastrado com o RUC informado.';
        $this->messages['pt_pt'][] = 'J?? existe um usu??rio cadastrado com o NIF informado.';

        $this->messages['en'][] = 'Username or Email';
        $this->messages['pt'][] = 'Usu??rio ou E-mail';
        $this->messages['es'][] = 'Nombre de usuario o correo electr??nico';
        $this->messages['pt_pt'][] = 'Usu??rio ou E-mail';

        $this->messages['en'][] = 'Phone';
        $this->messages['pt'][] = 'Fone';
        $this->messages['es'][] = 'Fone';
        $this->messages['pt_pt'][] = 'Telefone';

        $this->messages['en'][] = 'Postal Code';
        $this->messages['pt'][] = 'CEP';
        $this->messages['es'][] = 'Fone';
        $this->messages['pt_pt'][] = 'Codigo Postal';

        $this->messages['en'][] = 'Address';
        $this->messages['pt'][] = 'Endere??o';
        $this->messages['es'][] = 'Direccion';
        $this->messages['pt_pt'][] = 'Morada';

        $this->messages['en'][] = 'District';
        $this->messages['pt'][] = 'Bairro';
        $this->messages['es'][] = 'Barrio';
        $this->messages['pt_pt'][] = 'Freguesia';

        $this->messages['en'][] = 'State';
        $this->messages['pt'][] = 'Estado';
        $this->messages['es'][] = 'Estado';
        $this->messages['pt_pt'][] = 'Distrito';

        $this->messages['en'][] = 'City';
        $this->messages['pt'][] = 'Cidade';
        $this->messages['es'][] = 'Ciudad';
        $this->messages['pt_pt'][] = 'Localidade';

        $this->messages['en'][] = 'CNH';
        $this->messages['pt'][] = 'CNH';
        $this->messages['es'][] = 'CNH';
        $this->messages['pt_pt'][] = 'Carta de Condu????o';

        $this->messages['en'][] = 'Genre';
        $this->messages['pt'][] = 'Sexo';
        $this->messages['es'][] = 'Sexo';
        $this->messages['pt_pt'][] = 'G??nero';

        $this->messages['en'][] = 'Nascimento Data';
        $this->messages['pt'][] = 'Data de Nascimento';
        $this->messages['es'][] = 'Data de Nascimento';
        $this->messages['pt_pt'][] = 'Data de Nascimento';

        $this->messages['en'][] = 'Civil status';
        $this->messages['pt'][] = 'Estado Civil';
        $this->messages['es'][] = 'Estado Civil';
        $this->messages['pt_pt'][] = 'Estado Civil';

        $this->messages['en'][] = 'Country';
        $this->messages['pt'][] = 'Pa??s';
        $this->messages['es'][] = 'Pais';
        $this->messages['pt_pt'][] = 'Pa??s';

        $this->messages['en'][] = 'Special needs';
        $this->messages['pt'][] = 'Necessidades Especiais';
        $this->messages['es'][] = 'Necesidades especiales';
        $this->messages['pt_pt'][] = 'Necessidades Especiais';

        $this->messages['en'][] = 'Travel Availability';
        $this->messages['pt'][] = 'Disponibilidade Viagens';
        $this->messages['es'][] = 'Disponibilidad de viaje';
        $this->messages['pt_pt'][] = 'Necessidades Especiais';

        $this->messages['en'][] = 'Availability Changes';
        $this->messages['pt'][] = 'Disponibilidade Mudan??as';
        $this->messages['es'][] = 'Cambios de disponibilidad';
        $this->messages['pt_pt'][] = 'Disponibilidade Mudan??as';

        $this->messages['en'][] = 'Is employed';
        $this->messages['pt'][] = 'Est?? empregado';
        $this->messages['es'][] = 'Est?? empleado';
        $this->messages['pt_pt'][] = 'Est?? empregado';

        $this->messages['en'][] = 'Save and Next';
        $this->messages['pt'][] = 'Salvar e Pr??xima';
        $this->messages['es'][] = 'Guardar y siguiente';
        $this->messages['pt_pt'][] = 'Salvar e Pr??xima';

        $this->messages['en'][] = 'Intended position';
        $this->messages['pt'][] = 'Cargo Pretendido';
        $this->messages['es'][] = 'Posici??n deseada';
        $this->messages['pt_pt'][] = 'Cargo Pretendido';

        $this->messages['en'][] = 'Objectives';
        $this->messages['pt'][] = 'Objetivos';
        $this->messages['es'][] = 'Metas';
        $this->messages['pt_pt'][] = 'Objetivos';

        $this->messages['en'][] = 'What';
        $this->messages['pt'][] = 'Qual';
        $this->messages['es'][] = 'C??al';
        $this->messages['pt_pt'][] = 'Qual';

        $this->messages['en'][] = 'RG';
        $this->messages['pt'][] = 'RG';
        $this->messages['es'][] = 'C??al';
        $this->messages['pt_pt'][] = 'BI/Cart??o Cidad??o';

        $this->messages['en'][] = 'RG';
        $this->messages['pt'][] = 'RG';
        $this->messages['es'][] = 'C??al';
        $this->messages['pt_pt'][] = 'BI/Cart??o Cidad??o';
        
        $this->messages['en'][] = 'Curriculum';
        $this->messages['pt'][] = 'Curr??culo';
        $this->messages['es'][] = 'Historial profesional';
        $this->messages['pt_pt'][] = 'Curr??culo';

        $this->messages['en'][] = 'Vague dispose';
        $this->messages['pt'][] = 'Vagas Dispon??veis';
        $this->messages['es'][] = 'Vagas Dispon??veis';
        $this->messages['pt_pt'][] = 'Vagas Dispon??veis';

        $this->messages['en'][] = 'View Curriculum';
        $this->messages['pt'][] = 'Visualizar Curr??culo';
        $this->messages['es'][] = 'Visualizar Curr??culo';
        $this->messages['pt_pt'][] = 'Visualizar Curr??culo';

        $this->messages['en'][] = 'Listing Resumes';
        $this->messages['pt'][] = 'Listagem Curr??culos';
        $this->messages['es'][] = 'Listado de CV';
        $this->messages['pt_pt'][] = 'Listagem Curr??culos';

        $this->messages['en'][] = 'Knowledge Registration';
        $this->messages['pt'][] = 'Cadastro de Conhecimentos';
        $this->messages['es'][] = 'Registro de conocimientos';
        $this->messages['pt_pt'][] = 'Cadastro de Conhecimentos';
        
        $this->messages['en'][] = 'Jobs Register';
        $this->messages['pt'][] = 'Cadastro de Vagas';
        $this->messages['es'][] = 'Registro de vacantes';
        $this->messages['pt_pt'][] = 'Cadastro de Vagas';

        $this->messages['en'][] = 'Username or Email';
        $this->messages['pt'][] = 'Usu??rio ou E-mail';
        $this->messages['es'][] = 'Usuario o correo electr??nico';
        $this->messages['pt_pt'][] = 'Usu??rio ou E-mail';

        $this->messages['en'][] = 'Information';
        $this->messages['pt'][] = 'Informa????o';
        $this->messages['es'][] = 'Information';
        $this->messages['pt_pt'][] = 'Informa????o';

        $this->enWords = [];
        foreach ($this->messages['en'] as $key => $value)
        {
            $this->enWords[$value] = $key;
        }
    }
    
    /**
     * Returns the singleton instance
     * @return  Instance of self
     */
    public static function getInstance()
    {
        // if there's no instance
        if (empty(self::$instance))
        {
            // creates a new object
            self::$instance = new self;
        }
        // returns the created instance
        return self::$instance;
    }
    
    /**
     * Define the target language
     * @param $lang     Target language index
     */
    public static function setLanguage($lang)
    {
        $instance = self::getInstance();
        $instance->lang = $lang;
    }
    
    /**
     * Returns the target language
     * @return Target language index
     */
    public static function getLanguage()
    {
        $instance = self::getInstance();
        return $instance->lang;
    }
    
    /**
     * Translate a word to the target language
     * @param $word     Word to be translated
     * @return          Translated word
     */
    public static function translate($word, $param1 = NULL, $param2 = NULL, $param3 = NULL)
    {
        // get the self unique instance
        $instance = self::getInstance();
        // search by the numeric index of the word
        
        if (isset($instance->enWords[$word]) and !is_null($instance->enWords[$word]))
        {
            $key = $instance->enWords[$word]; //$key = array_search($word, $instance->messages['en']);
            
            // get the target language
            $language = self::getLanguage();
            // returns the translated word
            $message = $instance->messages[$language][$key];
            
            if (isset($param1))
            {
                $message = str_replace('^1', $param1, $message);
            }
            if (isset($param2))
            {
                $message = str_replace('^2', $param2, $message);
            }
            if (isset($param3))
            {
                $message = str_replace('^3', $param3, $message);
            }
            return $message;
        }
        else
        {
            return 'Message not found: '. $word;
        }
    }
    
    /**
     * Translate a template file
     */
    public static function translateTemplate($template)
    {
        // get the self unique instance
        $instance = self::getInstance();
        // search by translated words
        if(preg_match_all( '!_t\{(.*?)\}!i', $template, $match ) > 0)
        {
            foreach($match[1] as $word)
            {
                $translated = _t($word);
                $template = str_replace('_t{'.$word.'}', $translated, $template);
            }
        }
        return $template;
    }
}

/**
 * Facade to translate words
 * @param $word  Word to be translated
 * @param $param1 optional ^1
 * @param $param2 optional ^2
 * @param $param3 optional ^3
 * @return Translated word
 */
function _t($msg, $param1 = null, $param2 = null, $param3 = null)
{
    return ApplicationTranslator::translate($msg, $param1, $param2, $param3);
}
