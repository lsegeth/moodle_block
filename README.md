# moodle_block

## fail2ban

```
sudo apt update  
sudo apt install fail2ban  
sudo cp /etc/fail2ban/jail.conf /etc/fail2ban/jail.local  
sudo vim jail.local  

add "enabled = true" after [sshd] to enable ssh jail  

sudo systemctl enable fail2ban (so fail2ban runs automatically after reboot)  
sudo systemctl start fail2ban (to start fail2ban)  
```

## nginx, php, postgresql

sudo apt install nginx postgresql  

(https://www.digitalocean.com/community/tutorials/how-to-install-postgresql-on-ubuntu-22-04-quickstart)  
```
sudo -u postgres createuser --interactive (create postgresql user moodle)  
sudo -u postgres creadedb moodle -E UTF8  
sudo adduser moodle (add linux user moodle for database)  
```

Moodle hat nicht mit php8.1 funktioniert, habe dann php7.4 installiert.  
```
sudo add-apt-repository ppa:ondrej/php  
sudo apt update  
sudo apt install php7.4-fpm  
```
und weitere Pakete für Moodle  
```
sudo apt install php7.4-pgsql php7.4-xml php7.4-mbstring php7.4-curl php7.4-zip php7.4-gd php7.4-intl php7.4-xmlrpc php7.4-soap  
```

## moodle (https://docs.moodle.org/400/en/Installation_quick_guide , https://docs.moodle.org/400/en/Nginx)

```
cd; git clone -b MOODLE_310_STABLE git://git.moodle.org/moodle.git  
sudo cp moodle /var/www/html/  
sudo mkdir /var/www/html/moodledata  
sudo vim /etc/nginx/sites-enabled/default  
```

add location to server {}  
```
    location ~ [^/]\.php(/|$) {
        fastcgi_split_path_info  ^(.+\.php)(/.+)$;
        fastcgi_index            index.php;
        fastcgi_pass             unix:/var/run/php/php7.4-fpm.sock;
        include                  fastcgi_params;
        fastcgi_param   PATH_INFO       $fastcgi_path_info;
        fastcgi_param   SCRIPT_FILENAME $document_root$fastcgi_script_name;
    }
```

        
follow instructions in browser for moodle installation at http://ip_of_vm/moodle  

## let's encrypt (https://certbot.eff.org/instructions?ws=nginx&os=ubuntufocal)

```
sudo snap install core; sudo snap refresh core  
sudo snap install --classic certbot  
sudo certbot --nginx  
sudo vim /var/www/html/moodle/config.php  

change $CFG->wwwroot from "http://..." to "https://..."  
```

## moodle google search block (https://docs.moodle.org/dev/Blocks , https://developers.google.com/custom-search/v1/overview , https://developers.google.com/custom-search/v1/using_rest)

create files according to step-by-step guide  
changed name from simplehtml to google  
in moodle/blocks/google/block_google.php write simple curl function for custom google search  
(see block_google.php in repository)  




