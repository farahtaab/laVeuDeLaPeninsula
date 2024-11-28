# La Veu de la Península

## Descripció del projecte

Una aplicació Laravel que permet gestionar i visualitzar notícies amb funcionalitats avançades de categories i comments. Aquesta web està dissenyada amb un estil modern utilitzant Tailwind CSS i proporciona una experiència visual atractiva.

---

## Requeriments

Abans de començar, assegura't de tenir instal·lat:

- PHP 8.0 o superior
- Composer
- Node.js i npm
- MySQL o SQLite

---

## Instal·lació

Segueix aquests passos per descarregar i executar el projecte:

1. **Clonar el repositori**

   ```bash
   git clone https://github.com/farahtaab/laVeuDeLaPeninsula.git
   cd laVeuDeLaPeninsula
   ```

2. **Instal·lar dependències**

   Executa aquests comandos:

   ```bash
   composer install
   npm install
   npm run build
   ```

3. **Configurar l'entorn**

   Crea un fitxer `.env` basat en `.env.example`:

   ```bash
   cp .env.example .env
   ```

   Edita el fitxer `.env` i configura la connexió a la base de dades:

   ```env
   DB_CONNECTION=sqlite
   DB_DATABASE=/ruta/a/la/teva/base_de_dades.sqlite
   ```

4. **Migrar la base de dades i afegir dades**

   ```bash
   php artisan migrate --seed
   ```

5. **Executar el servidor**

   ```bash
   php artisan serve
   ```

   Obre el navegador i visita `http://localhost:8000`.

---

## Funcionalitats

- **Gestió de Notícies**: Crear, editar, eliminar i mostrar notícies amb imatges.
- **Categories**: Associar notícies a categories com ara Salut, Esports, Cultura, etc.
- **Comentaris**: Afegir, editar i eliminar comentaris a les notícies.

---

## Comandes útils

- **Actualitzar migracions**:

  ```bash
  php artisan migrate:fresh --seed
  ```

- **Executar servidor**:

  ```bash
  php artisan serve
  ```

- **Compilar assets amb Vite**:

  ```bash
  npm run build
  ```

---

## Contribuir

T'animem a contribuir al projecte:

1. Fes un fork.
2. Crea una branca (`git checkout -b feature/nova-funcionalitat`).
3. Puja els canvis (`git push origin feature/nova-funcionalitat`).
4. Obre una pull request.
