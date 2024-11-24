#bin/bash
# Script1.sh - Every 2 hours
0 */2 * * * /root/pokedexHackEPS/script1.sh >> /var/log/script1.log 2>&1

# Script2.sh - Every 33 minutes
*/33 * * * * /root/pokedexHackEPS/script2.sh >> /var/log/script2.log 2>&1

# Script3.sh - Every hour
0 * * * * /root/pokedexHackEPS/script3.sh >> /var/log/script3.log 2>&1

# Script4.sh - Every 1 hour 20 minutes
0 */1 * * * /bin/bash -c '/root/pokedexHackEPS/script4.sh && sleep 1200' >> /var/log/script4.log 2>&1

# Script5.sh - Every 2 hours
0 */2 * * * /root/pokedexHackEPS/script5.sh >> /var/log/script5.log 2>&1

# Script6.sh - Every 5 hours 33 minutes
33 */5 * * * /root/pokedexHackEPS/script6.sh >> /var/log/script6.log 2>&1

# Script7.sh - Every 1 hour 20 minutes
0 */1 * * * /bin/bash -c '/root/pokedexHackEPS/script7.sh && sleep 1200' >> /var/log/script7.log 2>&1

# Script8.sh - Every hour
0 * * * * /root/pokedexHackEPS/script8.sh >> /var/log/script8.log 2>&1

# Script9.sh - Every 2 hours
0 */2 * * * /root/pokedexHackEPS/script9.sh >> /var/log/script9.log 2>&1

# Script10.sh - Every 5 hours 33 minutes
33 */5 * * * /root/pokedexHackEPS/script10.sh >> /var/log/script10.log 2>&1

# Script11.sh - Every 30 minutes
*/30 * * * * /root/pokedexHackEPS/script11.sh >> /var/log/script11.log 2>&1

# Script12.sh - Every 1 hour 20 minutes
0 */1 * * * /bin/bash -c '/root/pokedexHackEPS/script12.sh && sleep 1200' >> /var/log/script12.log 2>&1