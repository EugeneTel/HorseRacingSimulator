# Horse Racing Simulator

**Installation**

- Clone the project
- Install Docker
- Run `docker-compose up --build`
- Go to the container `docker exec -it horse-php sh`
- Install dependencies `composer install`
- Create a database if not exist `php bin/console doctrine:database:create`
- Run migrations `php bin/console doctrine:migration:migrate`
- Open url `http://localhost:8080`
- Run tests `bin\phpunit`

**Description**

- Each horse has 3 stats: speed, strength, endurance
- Each stat ranges from 0.0 to 10.0
- A horse's speed is their base speed (5 m/s) + their speed stat (in m/s)
- Endurance represents how many hundreds of meters they can run at their best
speed, before the weight of the jockey slows them down
- A jockey slows the horse down by 5 m/s, but this effect is reduced by the horse's
strength * 8 as a percentage
- Each race is run by 8 randomly generated horses, over 1500m
- Up to 3 races are allowed at the same time

The webpage include

- A "create race" button which generates a new race of 8 random horses
- A button "progress" which advances all races by 10 "seconds" until all horses in the
race have completed 1500m
- Any currently running races, showing distance covered, horse position, current time
- The last 5 race results (top 3 positions and times to complete 1500m)
- The best ever time, and the stats of the horse that generated it

**How it looks like**
[link]()https://drive.google.com/open?id=1MzW8spQEPlyGpgPToXg-T7G2q_sgjpxd)