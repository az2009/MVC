Estrutura MVC basedo na estrutura de Rota/Módulos/Container do magento.

Install

Arquivo de configuração
 - app/Config/application.xml

Configurações

 <config>

    - Nao preciso explicar né
	<connections>
		<host>localhost</host>
		<user>user</user>
		<pass>pass</pass>
		<dbname>db</dbname>
		<charset>SET NAMES utf8</charset>
		<type>mysql</type>
	</connections>

	<path>
	 - Url da aplicação
		<url>http://jeffersonporto.com/mvc</url>

	 - Nome da pasta onde é registrado os módulos
		<path_register>register</path_register>

	 - Nome da pasta onde fica os controllers
		<path_controller>controller</path_controller>

	 - Caminho da pasta onde fica os módulos
		<path_modules>app/modules</path_modules>

	 - Caminho do árquivo de configuração do módulo
		<path_config>/etc/config.xml</path_config>

	 - Sufixo do método dos controllers
		<name_action>Action</name_action>

	 - Sufixo dos árquivos de controller
		<name_controller>Controller</name_controller>

	 - Extensão dos árquivos do módulo
		<ext_file>.php</ext_file>

	 - Mensagem de quando um controller não é encontrado
		<controller_not_found_msg>Controller não encontrado</controller_not_found_msg>

	 - Mensagem de quando uma rota não é encontrada
		<router_not_found_msg>Rota não encontrada</router_not_found_msg>

	 - Nome da pasta que vai as view dos módulos
		<path_view>view</path_view>

	 - Caminho do layout default da aplicação
		<path_layout>app/layout/Layout.phtml</path_layout>

     - Extensão dos árquivos de template
		<ext_file_view>.phtml</ext_file_view>

	 - Rota default:ex
	   http://exemplo.com.br/
	   A rota informa em baixo sera o primeiro módulo que a aplicação irá chamar quando for iniciada
		<router_default>index</router_default>

	</path>

</config>


































