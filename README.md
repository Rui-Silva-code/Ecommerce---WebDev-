# E-commerce - Webdev (Demo)

# Portuguese [README](README_PT.md)
## Overview
Academic project simulating a basic e-commerce with catalog, shopping cart, and checkout flow (simulated). Demonstrates **front-end and back-end integration** and **CRUD operations**.

**Status:** Demo / Not ready for production

---

## Technologies used
- PHP 7.4+ (back-end)  
- MySQL  
- HTML5, CSS3, Bootstrap  
- JavaScript (cart and validations)

---

## Main features
- Product listing and detail pages  
- Shopping cart using session  
- Simulated checkout process (without real payment gateway)  
- Product CRUD (simple admin area)

---

## Limitations and security
- No real payment integration (simulation only)  
- Use of `password_hash()` for password security and `prepared statements` for queries  
- Do not commit credentials or dumps with sensitive data

---

## Project structure
/imagens/ -> All images used on the site (products, banners, icons, etc.)

/sql/
lojaonline.sql -> Database schema and sample data

/* Public pages / front-end */
paginaprincipal.php -> Main shop page
formulario_compra.php -> Customer purchase form
finalizar_compra.php -> Checkout completion
salvar_compra.php -> Order processing

/* Admin area */
paginaadmin.php -> Admin dashboard
loginadmin.php -> Admin login
logout.php -> Admin logout
inserir_produto.php -> Add new product
alterar_produto.php -> Edit existing product
excluir_produto.php -> Delete product

/* Back-end / connections */
basedados.php -> Database connection


---

## Next steps
- Robust authentication with roles (admin / user)  
- Implement tests and continuous integration (CI)  
- Add pagination and filters in catalog

---

## Author
Rui Silva  
GitHub: https://github.com/Rui-Silva-code
