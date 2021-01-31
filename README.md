# simpleRestApiApp
Aplikacja w Symfony która umożliwia dodawanie i usuwanie użytkowników za pomocą RestAPI

W aplikacji istnieją 3 metody:
* Get: /api/users
Zwraca wszystkich użytkowników dostępnych w bazie
* Get: /api/user/{id}
Zwraca użytkownika o danym ID
* Post: /api/user
Dodaje użytkownika do bazy na podstawie 2 wymaganych parametrów:
name i surname

Instrukcja uruchomienia (wymagany jest zainstalowany Docker):
1. Przejdź do folderu z projektem
2. Uruchom serwer bazy danych:
   ```console
    docker run -d \
           --name simple_rest_api \
           -e POSTGRES_PASSWORD=password \
           -p 5432:5432 postgres
   ```
3. Utwórz bazę danych:
    ```console
    docker exec -it simple_rest_api psql -U postgres -c "create database simple_rest_api_db"
    ```
4. Zaimportuj do bazy plik sql ze strukturą tabel (hasło: password):
    ```console
    psql -U postgres -h 127.0.0.1 simple_rest_api_db < db-data/simple_rest_api_db.sql
    ```
5. Uruchom serwer PHP (jeżeli mamy pakiet php dostępny z poziomu terminala): 
    ```console
    php -S localhost:8000 -t public/
    ```
Aplikacja jest gotowa.
