# BuscaLogin
Serviço de Busca de Logins corporativos no Samba4/Active Directory

Desenvolvido em [PHP], utilizando [HTML 5] e [CSS 3],
Com [Bootstrap]+[FontAwesome]

### Instalação
* Instalação em CentOS 7.x >
	* PHP 5.4 >
		* (php-cli, php-pdo, php-ldap, php-common, php)
	* HTTPD 2.4.6 >
		* (httpd)
	* OpenLDAP Libs 2.4 >
		* (openldap-devel openldap openldap-clients)

```bash
# yum install php-cli php-pdo php-common php httpd openldap-devel openldap openldap-clients
```
Crie o vhost do httpd com o [template].

### Dev Team
* [Diego Neves]
* [Frankley Santos]

[Teófilo Otoni]:http://teofilootoni.mg.gov.br
[PHP]:https://php.net
[MariaDB]:https://mariadb.org
[HTML 5]:https://www.w3schools.com/html/html5_intro.asp
[CSS 3]:https://www.w3schools.com/css/css3_intro.asp
[Bootstrap]:http://getbootstrap.com
[FontAwesome]:http://fontawesome.io
[template]:https://github.com/PrefeituraTO/BuscaLogin/blob/master/contrib/001-VHOST_Template.conf
[Diego Neves]:https://github.com/diegoaceneves
[Frankley Santos]:https://github.com/frankleysantos
