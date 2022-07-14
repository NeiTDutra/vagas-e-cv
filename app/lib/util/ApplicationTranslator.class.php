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

        $this->messages['pt'][] = 'Arquivo não encontrado';
        $this->messages['pt'][] = 'Pesquisar';
        $this->messages['pt'][] = 'Cadastrar';
        $this->messages['pt'][] = 'Registro salvo';
        $this->messages['pt'][] = 'Deseja realmente excluir ?';
        $this->messages['pt'][] = 'Registro excluído';
        $this->messages['pt'][] = 'Função';
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
        $this->messages['pt'][] = 'Não';
        $this->messages['pt'][] = 'Janeiro';
        $this->messages['pt'][] = 'Fevereiro';
        $this->messages['pt'][] = 'Março';
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
        $this->messages['pt'][] = 'O campo ^1 não pode ter menos de ^2 caracteres';
        $this->messages['pt'][] = 'O campo ^1 não pode ter mais de ^2 caracteres';
        $this->messages['pt'][] = 'O campo ^1 não pode ser menor que ^2';
        $this->messages['pt'][] = 'O campo ^1 não pode ser maior que ^2';
        $this->messages['pt'][] = 'O campo ^1 é obrigatório';
        $this->messages['pt'][] = 'O campo ^1 não contém um CNPJ válido';
        $this->messages['pt'][] = 'O campo ^1 não contém um CPF válido';
        $this->messages['pt'][] = 'O campo ^1 contém um e-mail inválido';
        $this->messages['pt'][] = 'Permissão negada';
        $this->messages['pt'][] = 'Gerar';
        $this->messages['pt'][] = 'Listar';
        $this->messages['pt'][] = 'Senha errada';
        $this->messages['pt'][] = 'Usuário não encontrado';
        $this->messages['pt'][] = 'Usuário';
        $this->messages['pt'][] = 'Usuários';
        $this->messages['pt'][] = 'Senha';
        $this->messages['pt'][] = 'Usuário';
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
        $this->messages['pt'][] = 'As senhas não conferem';
        $this->messages['pt'][] = 'Entrar';
        $this->messages['pt'][] = 'Data';
        $this->messages['pt'][] = 'Coluna';
        $this->messages['pt'][] = 'Operação';
        $this->messages['pt'][] = 'Valor antigo';
        $this->messages['pt'][] = 'Valor novo';
        $this->messages['pt'][] = 'Banco de dados';
        $this->messages['pt'][] = 'Perfil';
        $this->messages['pt'][] = 'Mudar senha';
        $this->messages['pt'][] = 'Deixe vazio para manter a senha anterior';
        $this->messages['pt'][] = 'Resultados';
        $this->messages['pt'][] = 'Comando inválido';
        $this->messages['pt'][] = '^1 registros exibidos';
        $this->messages['pt'][] = 'Administração';
        $this->messages['pt'][] = 'Painel SQL';
        $this->messages['pt'][] = 'Log de acesso';
        $this->messages['pt'][] = 'Log de alterações';
        $this->messages['pt'][] = 'Log de SQL';
        $this->messages['pt'][] = 'Limpar formulário';
        $this->messages['pt'][] = 'Enviar';
        $this->messages['pt'][] = 'Mensagem';
        $this->messages['pt'][] = 'Mensagens';
        $this->messages['pt'][] = 'Assunto';
        $this->messages['pt'][] = 'Mensagem enviada com sucesso';
        $this->messages['pt'][] = 'Marcar como lida';
        $this->messages['pt'][] = 'Marcar como não lida';
        $this->messages['pt'][] = 'Ação';
        $this->messages['pt'][] = 'Ler';
        $this->messages['pt'][] = 'Origem';
        $this->messages['pt'][] = 'Verificado';
        $this->messages['pt'][] = 'Objeto ^1 não encontrado em ^2';
        $this->messages['pt'][] = 'Notificação';
        $this->messages['pt'][] = 'Notificações';
        $this->messages['pt'][] = 'Categorias';
        $this->messages['pt'][] = 'Enviar documentos';
        $this->messages['pt'][] = 'Meus documentos';
        $this->messages['pt'][] = 'Compartilhados comigo';
        $this->messages['pt'][] = 'Documento';
        $this->messages['pt'][] = 'Arquivo';
        $this->messages['pt'][] = 'Título';
        $this->messages['pt'][] = 'Descrição';
        $this->messages['pt'][] = 'Categoria';
        $this->messages['pt'][] = 'Data de submissão';
        $this->messages['pt'][] = 'Data de arquivamento';
        $this->messages['pt'][] = 'Upload';
        $this->messages['pt'][] = 'Download';
        $this->messages['pt'][] = 'Próximo';
        $this->messages['pt'][] = 'Documentos';
        $this->messages['pt'][] = 'Permissão';
        $this->messages['pt'][] = 'Unidade';
        $this->messages['pt'][] = 'Unidades';
        $this->messages['pt'][] = 'Adiciona';
        $this->messages['pt'][] = 'Ativo';
        $this->messages['pt'][] = 'Ativar/desativar';
        $this->messages['pt'][] = 'Usuário inativo';
        $this->messages['pt'][] = 'Envia mensagem';
        $this->messages['pt'][] = 'Ler mensagens';
        $this->messages['pt'][] = 'Já existe um cadastro com este usuário';
        $this->messages['pt'][] = 'Estatísticas de acesso';
        $this->messages['pt'][] = 'Acessos';
        $this->messages['pt'][] = 'Preferências';
        $this->messages['pt'][] = 'E-mail de origem';
        $this->messages['pt'][] = 'Autentica SMTP';
        $this->messages['pt'][] = 'Host SMTP';
        $this->messages['pt'][] = 'Porta SMTP';
        $this->messages['pt'][] = 'Usuário SMTP';
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
        $this->messages['pt'][] = 'Códigos de barra gerados com sucesso';
        $this->messages['pt'][] = 'Documento gerado com sucesso';
        $this->messages['pt'][] = 'Valor';
        $this->messages['pt'][] = 'Usuário';
        $this->messages['pt'][] = 'Senha';
        $this->messages['pt'][] = 'Porta';
        $this->messages['pt'][] = 'Tipo da base de dados';
        $this->messages['pt'][] = 'Usuário admin';
        $this->messages['pt'][] = 'Senha do usuário admin';
        $this->messages['pt'][] = 'Criar base de dados/usuário';
        $this->messages['pt'][] = 'Testar conexão';
        $this->messages['pt'][] = 'Nome da base de dados';
        $this->messages['pt'][] = 'Inserir permissões/programas';
        $this->messages['pt'][] = 'Base de dados e usuário criado com sucesso';
        $this->messages['pt'][] = 'Permissões e programas inseridos com sucesso';
        $this->messages['pt'][] = 'Atualizar config';
        $this->messages['pt'][] = 'Arquivo de configuração: ^1 atualizado com sucesso';
        $this->messages['pt'][] = 'Conexão realizada com sucesso';
        $this->messages['pt'][] = 'A base de dados ^1 não existe';
        $this->messages['pt'][] = 'Permissões/programas inseridos com sucesso';
        $this->messages['pt'][] = 'Os programas/permissões já foram inseridos';
        $this->messages['pt'][] = 'Instalando a sua aplicação';
        $this->messages['pt'][] = 'Verificação da versão do PHP e extensões instaladas';
        $this->messages['pt'][] = 'Verificação do PHP';
        $this->messages['pt'][] = 'Verificação de diretórios e arquivos';
        $this->messages['pt'][] = 'Configuração/criação de base de dados';
        $this->messages['pt'][] = 'Usuário admin';
        $this->messages['pt'][] = 'Senha do usuário admin';
        $this->messages['pt'][] = 'Inserir dados';
        $this->messages['pt'][] = 'Da base de dados:';
        $this->messages['pt'][] = 'A conexão com a base de dados ^1 falhou';
        $this->messages['pt'][] = 'Instalar';
        $this->messages['pt'][] = 'Bases de dados instaladas com sucesso';
        $this->messages['pt'][] = 'As bases de dados já foram instaladas';
        $this->messages['pt'][] = 'Unidade principal';
        $this->messages['pt'][] = 'Hora';
        $this->messages['pt'][] = 'Tipo';
        $this->messages['pt'][] = 'Falha ao ler o log de erros (^1)';
        $this->messages['pt'][] = 'O log de erros (^1) não permite escrita pelo usuário web, assim as mensagens devem estar incompletas';
        $this->messages['pt'][] = 'Revise o proprietário do arquivo de log. Ele deve ser igual ao usuário web (geralmente www-data, www, etc)';
        $this->messages['pt'][] = 'Log de erros está vazio ou não foi configurado corretamente. Defina o arquivo de log de erros, configurando <b>error_log</b> no php.ini';
        $this->messages['pt'][] = 'Erros não estão sendo registrados. Por favor, mude <b>log_errors = On</b> no php.ini';
        $this->messages['pt'][] = 'Erros não estão atualmente sendo exibidos por que <b>display_errors</b> está configurado para Off no php.ini';
        $this->messages['pt'][] = 'Esta configuração normalmente é recomendada para produção, não para o propósito de desenvolvimento';
        $this->messages['pt'][] = 'A localização atual do php.ini é <b>^1</b>';
        $this->messages['pt'][] = 'A localização atual do log de erros é <b>^1</b>';
        $this->messages['pt'][] = 'Log do PHP';
        $this->messages['pt'][] = 'Database explorer';
        $this->messages['pt'][] = 'Tabelas';
        $this->messages['pt'][] = 'Relatório gerado. Favor, habilitar os popups';
        $this->messages['pt'][] = 'Arquivo salvo';
        $this->messages['pt'][] = 'Editar página';
        $this->messages['pt'][] = 'Atualizar página';
        $this->messages['pt'][] = 'Módulo';
        $this->messages['pt'][] = 'Diretório';
        $this->messages['pt'][] = 'Código-fonte';
        $this->messages['pt'][] = 'Retorno inválido';
        $this->messages['pt'][] = 'Página';
        $this->messages['pt'][] = 'Falhas na conexão';
        $this->messages['pt'][] = 'Resumo da instalação da base de dados';
        $this->messages['pt'][] = 'Sem permissão de escrita no arquivo';
        $this->messages['pt'][] = 'Para que seja possível continuar com a instalação você deve conceder permissão de leitura para o diretório';
        $this->messages['pt'][] = 'Para que seja possível continuar com a instalação você deve conceder permissão de escrita para o diretório';
        $this->messages['pt'][] = 'Instalada';
        $this->messages['pt'][] = 'Diretório';
        $this->messages['pt'][] = 'Arquivo';
        $this->messages['pt'][] = 'Escrita';
        $this->messages['pt'][] = 'Leitura';
        $this->messages['pt'][] = 'Para que seja possível continuar com a instalação você deve conceder permissão de leitura para o arquivo';
        $this->messages['pt'][] = 'Para que seja possível continuar com a instalação você deve conceder permissão de escrita para o arquivo';
        $this->messages['pt'][] = 'Foto';
        $this->messages['pt'][] = 'Redefinir senha';
        $this->messages['pt'][] = 'Uma nova seed é necessária no application.ini por motivos de segurança';
        $this->messages['pt'][] = 'Troca de senha';
        $this->messages['pt'][] = 'Token expirado. Esta operação não é permitida';
        $this->messages['pt'][] = 'A senha foi alterada';
        $this->messages['pt'][] = 'Um usuário já está cadastrado com este e-mail';
        $this->messages['pt'][] = 'Credenciais LDAP erradas';
        $this->messages['pt'][] = 'Atualizar o menu sobregravando arquivo existente?';
        $this->messages['pt'][] = 'Menu atualizado com sucesso';
        $this->messages['pt'][] = 'Caminho menu';
        $this->messages['pt'][] = 'Adiciona ao menu';
        $this->messages['pt'][] = 'Remove do menu';
        $this->messages['pt'][] = 'Item removido do menu';
        $this->messages['pt'][] = 'Item adicionado ao menu';
        $this->messages['pt'][] = 'Ícone';
        $this->messages['pt'][] = 'Cadastro de usuário';
        $this->messages['pt'][] = 'O cadastro de usuários está desabilitado';
        $this->messages['pt'][] = 'A recuperação de senhas está desabilitada';
        $this->messages['pt'][] = 'Conta criada';
        $this->messages['pt'][] = 'Criar conta';
        $this->messages['pt'][] = 'Se você deseja reinstalar, edite o arquivo app/config/install.ini e altere installed = 1 para installed = 0. Apague o conteúdo no arquivo app/config/install.ini também';
        $this->messages['pt'][] = 'Erro de autorização';
        $this->messages['pt'][] = 'Sair';
        $this->messages['pt'][] = 'Chave REST não definida';
        $this->messages['pt'][] = 'Local';
        $this->messages['pt'][] = 'Remoto';
        $this->messages['pt'][] = 'Sucesso';
        $this->messages['pt'][] = 'Erro';
        $this->messages['pt'][] = 'Status';
        $this->messages['pt'][] = 'Atualiza permissões?';
        $this->messages['pt'][] = 'Modificado';
        $this->messages['pt'][] = 'CPF';
        $this->messages['pt'][] = 'Celular';

        $this->messages['pt_pt'][] = 'Arquivo não encontrado';
        $this->messages['pt_pt'][] = 'Pesquisar';
        $this->messages['pt_pt'][] = 'Cadastrar';
        $this->messages['pt_pt'][] = 'Registro salvo';
        $this->messages['pt_pt'][] = 'Deseja realmente excluir ?';
        $this->messages['pt_pt'][] = 'Registro excluído';
        $this->messages['pt_pt'][] = 'Função';
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
        $this->messages['pt_pt'][] = 'Não';
        $this->messages['pt_pt'][] = 'Janeiro';
        $this->messages['pt_pt'][] = 'Fevereiro';
        $this->messages['pt_pt'][] = 'Março';
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
        $this->messages['pt_pt'][] = 'O campo ^1 não pode ter menos de ^2 caracteres';
        $this->messages['pt_pt'][] = 'O campo ^1 não pode ter mais de ^2 caracteres';
        $this->messages['pt_pt'][] = 'O campo ^1 não pode ser menor que ^2';
        $this->messages['pt_pt'][] = 'O campo ^1 não pode ser maior que ^2';
        $this->messages['pt_pt'][] = 'O campo ^1 é obrigatório';
        $this->messages['pt_pt'][] = 'O campo ^1 não contém um CNPJ válido';
        $this->messages['pt_pt'][] = 'O campo ^1 não contém um NIF válido';
        $this->messages['pt_pt'][] = 'O campo ^1 contém um e-mail inválido';
        $this->messages['pt_pt'][] = 'Permissão negada';
        $this->messages['pt_pt'][] = 'Gerar';
        $this->messages['pt_pt'][] = 'Listar';
        $this->messages['pt_pt'][] = 'Palavra passe errada';
        $this->messages['pt_pt'][] = 'Usuário não encontrado';
        $this->messages['pt_pt'][] = 'Usuário';
        $this->messages['pt_pt'][] = 'Usuários';
        $this->messages['pt_pt'][] = 'Palavra passe';
        $this->messages['pt_pt'][] = 'Usuário';
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
        $this->messages['pt_pt'][] = 'As Palavra passes não conferem';
        $this->messages['pt_pt'][] = 'Entrar';
        $this->messages['pt_pt'][] = 'Data';
        $this->messages['pt_pt'][] = 'Coluna';
        $this->messages['pt_pt'][] = 'Operação';
        $this->messages['pt_pt'][] = 'Valor antigo';
        $this->messages['pt_pt'][] = 'Valor novo';
        $this->messages['pt_pt'][] = 'Banco de dados';
        $this->messages['pt_pt'][] = 'Perfil';
        $this->messages['pt_pt'][] = 'Mudar Palavra passe';
        $this->messages['pt_pt'][] = 'Deixe vazio para manter a Palavra passe anterior';
        $this->messages['pt_pt'][] = 'Resultados';
        $this->messages['pt_pt'][] = 'Comando inválido';
        $this->messages['pt_pt'][] = '^1 registros exibidos';
        $this->messages['pt_pt'][] = 'Administração';
        $this->messages['pt_pt'][] = 'Painel SQL';
        $this->messages['pt_pt'][] = 'Log de acesso';
        $this->messages['pt_pt'][] = 'Log de alterações';
        $this->messages['pt_pt'][] = 'Log de SQL';
        $this->messages['pt_pt'][] = 'Limpar formulário';
        $this->messages['pt_pt'][] = 'Enviar';
        $this->messages['pt_pt'][] = 'Mensagem';
        $this->messages['pt_pt'][] = 'Mensagens';
        $this->messages['pt_pt'][] = 'Assunto';
        $this->messages['pt_pt'][] = 'Mensagem enviada com sucesso';
        $this->messages['pt_pt'][] = 'Marcar como lida';
        $this->messages['pt_pt'][] = 'Marcar como não lida';
        $this->messages['pt_pt'][] = 'Ação';
        $this->messages['pt_pt'][] = 'Ler';
        $this->messages['pt_pt'][] = 'Origem';
        $this->messages['pt_pt'][] = 'Verificado';
        $this->messages['pt_pt'][] = 'Objeto ^1 não encontrado em ^2';
        $this->messages['pt_pt'][] = 'Notificação';
        $this->messages['pt_pt'][] = 'Notificações';
        $this->messages['pt_pt'][] = 'Categorias';
        $this->messages['pt_pt'][] = 'Enviar documentos';
        $this->messages['pt_pt'][] = 'Meus documentos';
        $this->messages['pt_pt'][] = 'Compartilhados comigo';
        $this->messages['pt_pt'][] = 'Documento';
        $this->messages['pt_pt'][] = 'Arquivo';
        $this->messages['pt_pt'][] = 'Título';
        $this->messages['pt_pt'][] = 'Descrição';
        $this->messages['pt_pt'][] = 'Categoria';
        $this->messages['pt_pt'][] = 'Data de submissão';
        $this->messages['pt_pt'][] = 'Data de arquivamento';
        $this->messages['pt_pt'][] = 'Upload';
        $this->messages['pt_pt'][] = 'Download';
        $this->messages['pt_pt'][] = 'Próximo';
        $this->messages['pt_pt'][] = 'Documentos';
        $this->messages['pt_pt'][] = 'Permissão';
        $this->messages['pt_pt'][] = 'Unidade';
        $this->messages['pt_pt'][] = 'Unidades';
        $this->messages['pt_pt'][] = 'Adiciona';
        $this->messages['pt_pt'][] = 'Ativo';
        $this->messages['pt_pt'][] = 'Ativar/desativar';
        $this->messages['pt_pt'][] = 'Usuário inativo';
        $this->messages['pt_pt'][] = 'Envia mensagem';
        $this->messages['pt_pt'][] = 'Ler mensagens';
        $this->messages['pt_pt'][] = 'Já existe um cadastro com este usuário';
        $this->messages['pt_pt'][] = 'Estatísticas de acesso';
        $this->messages['pt_pt'][] = 'Acessos';
        $this->messages['pt_pt'][] = 'Preferências';
        $this->messages['pt_pt'][] = 'E-mail de origem';
        $this->messages['pt_pt'][] = 'Autentica SMTP';
        $this->messages['pt_pt'][] = 'Host SMTP';
        $this->messages['pt_pt'][] = 'Porta SMTP';
        $this->messages['pt_pt'][] = 'Usuário SMTP';
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
        $this->messages['pt_pt'][] = 'Códigos de barra gerados com sucesso';
        $this->messages['pt_pt'][] = 'Documento gerado com sucesso';
        $this->messages['pt_pt'][] = 'Valor';
        $this->messages['pt_pt'][] = 'Usuário';
        $this->messages['pt_pt'][] = 'Palavra passe';
        $this->messages['pt_pt'][] = 'Porta';
        $this->messages['pt_pt'][] = 'Tipo da base de dados';
        $this->messages['pt_pt'][] = 'Usuário admin';
        $this->messages['pt_pt'][] = 'Palavra passe do usuário admin';
        $this->messages['pt_pt'][] = 'Criar base de dados/usuário';
        $this->messages['pt_pt'][] = 'Testar conexão';
        $this->messages['pt_pt'][] = 'Nome da base de dados';
        $this->messages['pt_pt'][] = 'Inserir permissões/programas';
        $this->messages['pt_pt'][] = 'Base de dados e usuário criado com sucesso';
        $this->messages['pt_pt'][] = 'Permissões e programas inseridos com sucesso';
        $this->messages['pt_pt'][] = 'Atualizar config';
        $this->messages['pt_pt'][] = 'Arquivo de configuração: ^1 atualizado com sucesso';
        $this->messages['pt_pt'][] = 'Conexão realizada com sucesso';
        $this->messages['pt_pt'][] = 'A base de dados ^1 não existe';
        $this->messages['pt_pt'][] = 'Permissões/programas inseridos com sucesso';
        $this->messages['pt_pt'][] = 'Os programas/permissões já foram inseridos';
        $this->messages['pt_pt'][] = 'Instalando a sua aplicação';
        $this->messages['pt_pt'][] = 'Verificação da versão do PHP e extensões instaladas';
        $this->messages['pt_pt'][] = 'Verificação do PHP';
        $this->messages['pt_pt'][] = 'Verificação de diretórios e arquivos';
        $this->messages['pt_pt'][] = 'Configuração/criação de base de dados';
        $this->messages['pt_pt'][] = 'Usuário admin';
        $this->messages['pt_pt'][] = 'Palavra passe do usuário admin';
        $this->messages['pt_pt'][] = 'Inserir dados';
        $this->messages['pt_pt'][] = 'Da base de dados:';
        $this->messages['pt_pt'][] = 'A conexão com a base de dados ^1 falhou';
        $this->messages['pt_pt'][] = 'Instalar';
        $this->messages['pt_pt'][] = 'Bases de dados instaladas com sucesso';
        $this->messages['pt_pt'][] = 'As bases de dados já foram instaladas';
        $this->messages['pt_pt'][] = 'Unidade principal';
        $this->messages['pt_pt'][] = 'Hora';
        $this->messages['pt_pt'][] = 'Tipo';
        $this->messages['pt_pt'][] = 'Falha ao ler o log de erros (^1)';
        $this->messages['pt_pt'][] = 'O log de erros (^1) não permite escrita pelo usuário web, assim as mensagens devem estar incompletas';
        $this->messages['pt_pt'][] = 'Revise o proprietário do arquivo de log. Ele deve ser igual ao usuário web (geralmente www-data, www, etc)';
        $this->messages['pt_pt'][] = 'Log de erros está vazio ou não foi configurado corretamente. Defina o arquivo de log de erros, configurando <b>error_log</b> no php.ini';
        $this->messages['pt_pt'][] = 'Erros não estão sendo registrados. Por favor, mude <b>log_errors = On</b> no php.ini';
        $this->messages['pt_pt'][] = 'Erros não estão atualmente sendo exibidos por que <b>display_errors</b> está configurado para Off no php.ini';
        $this->messages['pt_pt'][] = 'Esta configuração normalmente é recomendada para produção, não para o propósito de desenvolvimento';
        $this->messages['pt_pt'][] = 'A localização atual do php.ini é <b>^1</b>';
        $this->messages['pt_pt'][] = 'A localização atual do log de erros é <b>^1</b>';
        $this->messages['pt_pt'][] = 'Log do PHP';
        $this->messages['pt_pt'][] = 'Database explorer';
        $this->messages['pt_pt'][] = 'Tabelas';
        $this->messages['pt_pt'][] = 'Relatório gerado. Favor, habilitar os popups';
        $this->messages['pt_pt'][] = 'Arquivo salvo';
        $this->messages['pt_pt'][] = 'Editar página';
        $this->messages['pt_pt'][] = 'Atualizar página';
        $this->messages['pt_pt'][] = 'Módulo';
        $this->messages['pt_pt'][] = 'Diretório';
        $this->messages['pt_pt'][] = 'Código-fonte';
        $this->messages['pt_pt'][] = 'Retorno inválido';
        $this->messages['pt_pt'][] = 'Página';
        $this->messages['pt_pt'][] = 'Falhas na conexão';
        $this->messages['pt_pt'][] = 'Resumo da instalação da base de dados';
        $this->messages['pt_pt'][] = 'Sem permissão de escrita no arquivo';
        $this->messages['pt_pt'][] = 'Para que seja possível continuar com a instalação você deve conceder permissão de leitura para o diretório';
        $this->messages['pt_pt'][] = 'Para que seja possível continuar com a instalação você deve conceder permissão de escrita para o diretório';
        $this->messages['pt_pt'][] = 'Instalada';
        $this->messages['pt_pt'][] = 'Diretório';
        $this->messages['pt_pt'][] = 'Arquivo';
        $this->messages['pt_pt'][] = 'Escrita';
        $this->messages['pt_pt'][] = 'Leitura';
        $this->messages['pt_pt'][] = 'Para que seja possível continuar com a instalação você deve conceder permissão de leitura para o arquivo';
        $this->messages['pt_pt'][] = 'Para que seja possível continuar com a instalação você deve conceder permissão de escrita para o arquivo';
        $this->messages['pt_pt'][] = 'Foto';
        $this->messages['pt_pt'][] = 'Redefinir Palavra passe';
        $this->messages['pt_pt'][] = 'Uma nova seed é necessária no application.ini por motivos de segurança';
        $this->messages['pt_pt'][] = 'Troca de Palavra passe';
        $this->messages['pt_pt'][] = 'Token expirado. Esta operação não é permitida';
        $this->messages['pt_pt'][] = 'A Palavra passe foi alterada';
        $this->messages['pt_pt'][] = 'Um usuário já está cadastrado com este e-mail';
        $this->messages['pt_pt'][] = 'Credenciais LDAP erradas';
        $this->messages['pt_pt'][] = 'Atualizar o menu sobregravando arquivo existente?';
        $this->messages['pt_pt'][] = 'Menu atualizado com sucesso';
        $this->messages['pt_pt'][] = 'Caminho menu';
        $this->messages['pt_pt'][] = 'Adiciona ao menu';
        $this->messages['pt_pt'][] = 'Remove do menu';
        $this->messages['pt_pt'][] = 'Item removido do menu';
        $this->messages['pt_pt'][] = 'Item adicionado ao menu';
        $this->messages['pt_pt'][] = 'Ícone';
        $this->messages['pt_pt'][] = 'Cadastro de usuário';
        $this->messages['pt_pt'][] = 'O cadastro de usuários está desabilitado';
        $this->messages['pt_pt'][] = 'A recuperação de Palavra passes está desabilitada';
        $this->messages['pt_pt'][] = 'Conta criada';
        $this->messages['pt_pt'][] = 'Criar conta';
        $this->messages['pt_pt'][] = 'Se você deseja reinstalar, edite o arquivo app/config/install.ini e altere installed = 1 para installed = 0. Apague o conteúdo no arquivo app/config/install.ini também';
        $this->messages['pt_pt'][] = 'Erro de autorização';
        $this->messages['pt_pt'][] = 'Sair';
        $this->messages['pt_pt'][] = 'Chave REST não definida';
        $this->messages['pt_pt'][] = 'Local';
        $this->messages['pt_pt'][] = 'Remoto';
        $this->messages['pt_pt'][] = 'Sucesso';
        $this->messages['pt_pt'][] = 'Erro';
        $this->messages['pt_pt'][] = 'Status';
        $this->messages['pt_pt'][] = 'Atualiza permissões?';
        $this->messages['pt_pt'][] = 'Modificado';
        $this->messages['pt_pt'][] = 'NIF';
        $this->messages['pt_pt'][] = 'Telemóvel';

        $this->messages['es'][] = 'Archivo no encontrado';
        $this->messages['es'][] = 'Buscar';
        $this->messages['es'][] = 'Registrar';
        $this->messages['es'][] = 'Registro guardado';
        $this->messages['es'][] = 'Deseas realmente eliminar ?';
        $this->messages['es'][] = 'Registro eliminado';
        $this->messages['es'][] = 'Función';
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
        $this->messages['es'][] = 'Sí';
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
        $this->messages['es'][] = 'El campo ^1 no contiene un CNPJ válido';
        $this->messages['es'][] = 'El campo ^1 no contiene un CPF válido';
        $this->messages['es'][] = 'El campo ^1 contiene um e-mail inválido';
        $this->messages['es'][] = 'Permiso denegado';
        $this->messages['es'][] = 'Generar';
        $this->messages['es'][] = 'Listar';
        $this->messages['es'][] = 'Contraseña incorrecta';
        $this->messages['es'][] = 'Usuário no encontrado';
        $this->messages['es'][] = 'Usuário';
        $this->messages['es'][] = 'Usuários';
        $this->messages['es'][] = 'Contraseña';
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
        $this->messages['es'][] = 'Confirme contraseña';
        $this->messages['es'][] = 'Pantalla inicial';
        $this->messages['es'][] = 'Nombre da la Pantalla';
        $this->messages['es'][] = 'Las contraseñas no conciden';
        $this->messages['es'][] = 'Ingresar';
        $this->messages['es'][] = 'Fecha';
        $this->messages['es'][] = 'Columna';
        $this->messages['es'][] = 'Operación';
        $this->messages['es'][] = 'Valor anterior';
        $this->messages['es'][] = 'Valor nuevo';
        $this->messages['es'][] = 'Base de datos';
        $this->messages['es'][] = 'Perfil';
        $this->messages['es'][] = 'Cambiar contraseña';
        $this->messages['es'][] = 'Deje vacio para mantener la contraseña anterior';
        $this->messages['es'][] = 'Resultados';
        $this->messages['es'][] = 'Comando inválido';
        $this->messages['es'][] = '^1 registros  exhibidos';
        $this->messages['es'][] = 'Administración';
        $this->messages['es'][] = 'Panel SQL';
        $this->messages['es'][] = 'Log de acceso';
        $this->messages['es'][] = 'Log de modificaciones';
        $this->messages['es'][] = 'Log de SQL';
        $this->messages['es'][] = 'Limpiar formulário';
        $this->messages['es'][] = 'Enviar';
        $this->messages['es'][] = 'Mensaje';
        $this->messages['es'][] = 'Mensajes';
        $this->messages['es'][] = 'Asunto';
        $this->messages['es'][] = 'Mensaje enviada exitosamente';
        $this->messages['es'][] = 'Marcar como leída';
        $this->messages['es'][] = 'Marcar como no leída';
        $this->messages['es'][] = 'Acción';
        $this->messages['es'][] = 'Leer';
        $this->messages['es'][] = 'Origen';
        $this->messages['es'][] = 'Verificado';
        $this->messages['es'][] = 'Objeto ^1 no encontrado en ^2';
        $this->messages['es'][] = 'Notificación';
        $this->messages['es'][] = 'Notificaciones';
        $this->messages['es'][] = 'Categorias';
        $this->messages['es'][] = 'Enviar documentos';
        $this->messages['es'][] = 'Mis documentos';
        $this->messages['es'][] = 'Compartidos conmigo';
        $this->messages['es'][] = 'Documento';
        $this->messages['es'][] = 'Archivo';
        $this->messages['es'][] = 'Título';
        $this->messages['es'][] = 'Descripción';
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
        $this->messages['es'][] = 'Usuário desactivado';
        $this->messages['es'][] = 'Envia mensaje';
        $this->messages['es'][] = 'Leer mensaje';
        $this->messages['es'][] = 'Un usuário ya está registrado con este login';
        $this->messages['es'][] = 'Estadisticas de acceso';
        $this->messages['es'][] = 'Accesos';
        $this->messages['es'][] = 'Preferencias';
        $this->messages['es'][] = 'E-mail de origen';
        $this->messages['es'][] = 'Autentica SMTP';
        $this->messages['es'][] = 'Host SMTP';
        $this->messages['es'][] = 'Puerta SMTP';
        $this->messages['es'][] = 'Usuário SMTP';
        $this->messages['es'][] = 'Contraseña SMTP';
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
        $this->messages['es'][] = 'Diseño generado con éxito';
        $this->messages['es'][] = 'QR codes generados con éxito';
        $this->messages['es'][] = 'Códigos de barra generados con éxito';
        $this->messages['es'][] = 'Documento generado con éxito';
        $this->messages['es'][] = 'Valor';
        $this->messages['es'][] = 'Usuário';
        $this->messages['es'][] = 'Contraseña';
        $this->messages['es'][] = 'Puerta';
        $this->messages['es'][] = 'Tipo de base de datos';
        $this->messages['es'][] = 'Usuário admin';
        $this->messages['es'][] = 'Contraseña del usuário admin';
        $this->messages['es'][] = 'Crear base de datos/usuário';
        $this->messages['es'][] = 'Testear conexión';
        $this->messages['es'][] = 'Nombree de la base de datos';
        $this->messages['es'][] = 'Ingresar permisos/programas';
        $this->messages['es'][] = 'Base de datos y usuário creado con éxito';
        $this->messages['es'][] = 'Permisos y programas agregados con éxito';
        $this->messages['es'][] = 'Actualizar configuración';
        $this->messages['es'][] = 'Archivo de configuración: ^1 actualizado con éxito';
        $this->messages['es'][] = 'Conexión realizada con éxito';
        $this->messages['es'][] = 'La base de datos ^1 no existe';
        $this->messages['es'][] = 'Permisos/programas agregados con éxito';
        $this->messages['es'][] = 'Los programas/permisos ya fueron agregados';
        $this->messages['es'][] = 'Instalando en su aplicación';
        $this->messages['es'][] = 'Verficación de la version del PHP y extenciones instaladas';
        $this->messages['es'][] = 'Verficación del PHP';
        $this->messages['es'][] = 'Verficación de directorios y archivos';
        $this->messages['es'][] = 'Configuración/creación de la base de datos';
        $this->messages['es'][] = 'Usuário admin';
        $this->messages['es'][] = 'Contraseña del usuário admin';
        $this->messages['es'][] = 'Ingresar datos';
        $this->messages['es'][] = 'De la base de datos:';
        $this->messages['es'][] = 'La conexión con la base de datos ^1 falló';
        $this->messages['es'][] = 'Instalar';
        $this->messages['es'][] = 'Bases de datos instaladas con éxito';
        $this->messages['es'][] = 'Las bases de datos ya fueron instaladas';
        $this->messages['es'][] = 'Unidad principal';
        $this->messages['es'][] = 'Hora';
        $this->messages['es'][] = 'Tipo';
        $this->messages['es'][] = 'Falla al leer el log de errores (^1)';
        $this->messages['es'][] = 'El log de errores (^1) no permite escritura por el usuário web, así que los mensajes deben estar incompletos';
        $this->messages['es'][] = 'Revise el propietario del archivo de log. Debe ser igual al usuário web (generalmente www-data, www, etc)';
        $this->messages['es'][] = 'Log de errores está vacio o no fue configurado correctamente. Defina el archivo de log de errores, configurando <b>error_log</b> en el php.ini';
        $this->messages['es'][] = 'Errores no estan siendo registrados. Por favor, modifique <b>log_errors = On</b> en el php.ini';
        $this->messages['es'][] = 'Errores no estan actualmente siendo mostrados porque <b>display_errors</b> está configurado para Off en el php.ini';
        $this->messages['es'][] = 'Esta configuración normalmente es recomendada para producción, no para el propósito de desarrollo';
        $this->messages['es'][] = 'La ubicación actual del php.ini es <b>^1</b>';
        $this->messages['es'][] = 'La ubicación actual del log de errores es <b>^1</b>';
        $this->messages['es'][] = 'Log del PHP';
        $this->messages['es'][] = 'Database explorer';
        $this->messages['es'][] = 'Tablas';
        $this->messages['es'][] = 'Reporte generado. Favor, habilitar los popups';
        $this->messages['es'][] = 'Archivo guardado';
        $this->messages['es'][] = 'Modificar página';
        $this->messages['es'][] = 'Actualizar página';
        $this->messages['es'][] = 'Módulo';
        $this->messages['es'][] = 'Directório';
        $this->messages['es'][] = 'Código-fuente';
        $this->messages['es'][] = 'Retorno inválido';
        $this->messages['es'][] = 'Página';
        $this->messages['es'][] = 'Fallas en la conexión';
        $this->messages['es'][] = 'Resumen de la instalación de la base de datos';
        $this->messages['es'][] = 'Sin permiso de escritura en el archivo';
        $this->messages['es'][] = 'Para que sea posible continuar con la instalación usted debe conceder permisos de lectura para el directório';
        $this->messages['es'][] = 'Para que sea posible continuar con la instalación usted debe conceder permisos de escritura para el directório';
        $this->messages['es'][] = 'Instalada';
        $this->messages['es'][] = 'Directório';
        $this->messages['es'][] = 'Archivo';
        $this->messages['es'][] = 'Escritura';
        $this->messages['es'][] = 'Lectura';
        $this->messages['es'][] = 'Para que sea posible continuar con la instalación usted debe conceder permisos de lectura para el archivo';
        $this->messages['es'][] = 'Para que sea posible continuar con la instalación usted debe conceder permisos de escritura para el archivo';
        $this->messages['es'][] = 'Foto';
        $this->messages['es'][] = 'Cambiar contraseña';
        $this->messages['es'][] = 'Una nueva seed es necesaria en application.ini por motivos de seguridad';
        $this->messages['es'][] = 'Cambiar la contraseña';
        $this->messages['es'][] = 'Token expirado. Esta operación no está permitida';
        $this->messages['es'][] = 'La contraseña fue modificada';
        $this->messages['es'][] = 'Un usuário ya está registrado con este e-mail';
        $this->messages['es'][] = 'Credenciales LDAP incorrectas';
        $this->messages['es'][] = 'Actualizar el menu reemplazando el archivo existente?';
        $this->messages['es'][] = 'Menu actualizado con éxito';
        $this->messages['es'][] = 'Dirección del menu';
        $this->messages['es'][] = 'Agregar al menu';
        $this->messages['es'][] = 'Eliminar del menu';
        $this->messages['es'][] = 'Iten eliminado del menu';
        $this->messages['es'][] = 'Iten agregado al menu';
        $this->messages['es'][] = 'Ícono';
        $this->messages['es'][] = 'Registro de usuário';
        $this->messages['es'][] = 'El registro de usuários está desactivado';
        $this->messages['es'][] = 'La recuperación de contraseña está desactivada';
        $this->messages['es'][] = 'Cuenta creada';
        $this->messages['es'][] = 'Crear cuenta';
        $this->messages['es'][] = 'Si desea reinstalar, edite el archivo app/config/install.ini y cambie installed = 1 a installed = 0. Borre el contenido en el archivo app/config/install.ini también';
        $this->messages['es'][] = 'Error de autorización';
        $this->messages['es'][] = 'Salir';
        $this->messages['es'][] = 'Clave REST no definida';
        $this->messages['es'][] = 'Local';
        $this->messages['es'][] = 'Remoto';
        $this->messages['es'][] = 'Éxito';
        $this->messages['es'][] = 'Error';
        $this->messages['es'][] = 'Estado';
        $this->messages['es'][] = 'Actualizar permisos?';
        $this->messages['es'][] = 'Cambiado';
        $this->messages['es'][] = 'RUC';
        $this->messages['es'][] = 'Fone';

        $this->messages['en'][] = 'Já existe um usuário cadastrado com o CPF informado.';
        $this->messages['pt'][] = 'Já existe um usuário cadastrado com o CPF informado.';
        $this->messages['es'][] = 'Já existe um usuário cadastrado com o RUC informado.';
        $this->messages['pt_pt'][] = 'Já existe um usuário cadastrado com o NIF informado.';

        $this->messages['en'][] = 'Username or Email';
        $this->messages['pt'][] = 'Usuário ou E-mail';
        $this->messages['es'][] = 'Nombre de usuario o correo electrónico';
        $this->messages['pt_pt'][] = 'Usuário ou E-mail';

        $this->messages['en'][] = 'Phone';
        $this->messages['pt'][] = 'Fone';
        $this->messages['es'][] = 'Fone';
        $this->messages['pt_pt'][] = 'Telefone';

        $this->messages['en'][] = 'Postal Code';
        $this->messages['pt'][] = 'CEP';
        $this->messages['es'][] = 'Fone';
        $this->messages['pt_pt'][] = 'Codigo Postal';

        $this->messages['en'][] = 'Address';
        $this->messages['pt'][] = 'Endereço';
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
        $this->messages['pt_pt'][] = 'Carta de Condução';

        $this->messages['en'][] = 'Genre';
        $this->messages['pt'][] = 'Sexo';
        $this->messages['es'][] = 'Sexo';
        $this->messages['pt_pt'][] = 'Gênero';

        $this->messages['en'][] = 'Nascimento Data';
        $this->messages['pt'][] = 'Data de Nascimento';
        $this->messages['es'][] = 'Data de Nascimento';
        $this->messages['pt_pt'][] = 'Data de Nascimento';

        $this->messages['en'][] = 'Civil status';
        $this->messages['pt'][] = 'Estado Civil';
        $this->messages['es'][] = 'Estado Civil';
        $this->messages['pt_pt'][] = 'Estado Civil';

        $this->messages['en'][] = 'Country';
        $this->messages['pt'][] = 'País';
        $this->messages['es'][] = 'Pais';
        $this->messages['pt_pt'][] = 'País';

        $this->messages['en'][] = 'Special needs';
        $this->messages['pt'][] = 'Necessidades Especiais';
        $this->messages['es'][] = 'Necesidades especiales';
        $this->messages['pt_pt'][] = 'Necessidades Especiais';

        $this->messages['en'][] = 'Travel Availability';
        $this->messages['pt'][] = 'Disponibilidade Viagens';
        $this->messages['es'][] = 'Disponibilidad de viaje';
        $this->messages['pt_pt'][] = 'Necessidades Especiais';

        $this->messages['en'][] = 'Availability Changes';
        $this->messages['pt'][] = 'Disponibilidade Mudanças';
        $this->messages['es'][] = 'Cambios de disponibilidad';
        $this->messages['pt_pt'][] = 'Disponibilidade Mudanças';

        $this->messages['en'][] = 'Is employed';
        $this->messages['pt'][] = 'Está empregado';
        $this->messages['es'][] = 'Está empleado';
        $this->messages['pt_pt'][] = 'Está empregado';

        $this->messages['en'][] = 'Save and Next';
        $this->messages['pt'][] = 'Salvar e Próxima';
        $this->messages['es'][] = 'Guardar y siguiente';
        $this->messages['pt_pt'][] = 'Salvar e Próxima';

        $this->messages['en'][] = 'Intended position';
        $this->messages['pt'][] = 'Cargo Pretendido';
        $this->messages['es'][] = 'Posición deseada';
        $this->messages['pt_pt'][] = 'Cargo Pretendido';

        $this->messages['en'][] = 'Objectives';
        $this->messages['pt'][] = 'Objetivos';
        $this->messages['es'][] = 'Metas';
        $this->messages['pt_pt'][] = 'Objetivos';

        $this->messages['en'][] = 'What';
        $this->messages['pt'][] = 'Qual';
        $this->messages['es'][] = 'Cúal';
        $this->messages['pt_pt'][] = 'Qual';

        $this->messages['en'][] = 'RG';
        $this->messages['pt'][] = 'RG';
        $this->messages['es'][] = 'Cúal';
        $this->messages['pt_pt'][] = 'BI/Cartão Cidadão';

        $this->messages['en'][] = 'RG';
        $this->messages['pt'][] = 'RG';
        $this->messages['es'][] = 'Cúal';
        $this->messages['pt_pt'][] = 'BI/Cartão Cidadão';
        
        $this->messages['en'][] = 'Curriculum';
        $this->messages['pt'][] = 'Currículo';
        $this->messages['es'][] = 'Historial profesional';
        $this->messages['pt_pt'][] = 'Currículo';

        $this->messages['en'][] = 'Vague dispose';
        $this->messages['pt'][] = 'Vagas Disponíveis';
        $this->messages['es'][] = 'Vagas Disponíveis';
        $this->messages['pt_pt'][] = 'Vagas Disponíveis';

        $this->messages['en'][] = 'View Curriculum';
        $this->messages['pt'][] = 'Visualizar Currículo';
        $this->messages['es'][] = 'Visualizar Currículo';
        $this->messages['pt_pt'][] = 'Visualizar Currículo';

        $this->messages['en'][] = 'Listing Resumes';
        $this->messages['pt'][] = 'Listagem Currículos';
        $this->messages['es'][] = 'Listado de CV';
        $this->messages['pt_pt'][] = 'Listagem Currículos';

        $this->messages['en'][] = 'Knowledge Registration';
        $this->messages['pt'][] = 'Cadastro de Conhecimentos';
        $this->messages['es'][] = 'Registro de conocimientos';
        $this->messages['pt_pt'][] = 'Cadastro de Conhecimentos';
        
        $this->messages['en'][] = 'Jobs Register';
        $this->messages['pt'][] = 'Cadastro de Vagas';
        $this->messages['es'][] = 'Registro de vacantes';
        $this->messages['pt_pt'][] = 'Cadastro de Vagas';

        $this->messages['en'][] = 'Username or Email';
        $this->messages['pt'][] = 'Usuário ou E-mail';
        $this->messages['es'][] = 'Usuario o correo electrónico';
        $this->messages['pt_pt'][] = 'Usuário ou E-mail';

        $this->messages['en'][] = 'Information';
        $this->messages['pt'][] = 'Informação';
        $this->messages['es'][] = 'Information';
        $this->messages['pt_pt'][] = 'Informação';

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