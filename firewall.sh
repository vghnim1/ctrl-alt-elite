#!/bin/bash

DMZ_IP="10.147.17.72"
WEB_IP="10.147.17.52"
RMQ_IP="10.147.17.160"
DB_IP="10.147.17.52"

read -p "Enter the your role (dmz/web/rmq/db): " ROLE
echo "Configuring firewall for $ROLE..."

case "$ROLE" in

    dmz)
        echo "Applying DMZ firewall rules..."
        sudo ufw allow from $WEB_IP to any port 80 proto tcp
        sudo ufw allow from $WEB_IP to any port 443 proto tcp
        sudo ufw allow from $DMZ_IP to any port 22 proto tcp
        sudo ufw deny from any
        ;;
    
    web)
        echo "Applying Web firewall rules..."
        sudo ufw allow from $DMZ_IP to any port 80 proto tcp
        sudo ufw allow from $DMZ_IP to any port 443 proto tcp
        sudo ufw allow from $RMQ_IP to any port 5672 proto tcp
        sudo ufw deny from any
        ;;
    rmq)
        echo "Applying RabbitMQ firewall rules..."
        sudo ufw allow from $WEB_IP to any port 5672 proto tcp
        sudo ufw allow from $DB_IP to any port 5672 proto tcp
        sudo ufw deny from any
        ;;
    db)
        echo "Applying Database firewall rules..."
        sudo ufw allow from $RMQ_IP to any port 3306 proto tcp
        sudo ufw deny from any
        ;;
    *)
        echo "Unknown role. No firewall rules applied."
        ;;
esac

echo "Enabling firewall.."
sudo ufw enable
sudo ufw status verbose
