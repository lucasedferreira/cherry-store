CREATE TABLE product_categories (
  id SERIAL PRIMARY KEY,
  name varchar(255) NOT NULL,
  tax decimal NOT NULL,
  created_at TIMESTAMP NOT NULL DEFAULT now(),
  updated_at TIMESTAMP NOT NULL DEFAULT now()
);

CREATE TABLE products (
  id SERIAL PRIMARY KEY,
  name varchar(255) NOT NULL,
  price decimal NOT NULL,
  category_id integer NOT NULL,
  created_at TIMESTAMP NOT NULL DEFAULT now(),
  updated_at TIMESTAMP NOT NULL DEFAULT now(),
  FOREIGN KEY (category_id) REFERENCES product_categories (id) ON DELETE CASCADE
);

CREATE TABLE orders (
  id SERIAL PRIMARY KEY,
  subtotal decimal NOT NULL,
  tax_total decimal NOT NULL,
  total decimal NOT NULL,
  created_at TIMESTAMP NOT NULL DEFAULT now(),
  updated_at TIMESTAMP NOT NULL DEFAULT now()
);

CREATE TABLE order_products (
  id SERIAL PRIMARY KEY,
  order_id integer NOT NULL,
  product_id integer NOT NULL,
  product_name varchar(255) NOT NULL,
  product_price decimal NOT NULL,
  product_tax decimal NOT NULL,
  product_quantity decimal NOT NULL,
  total decimal NOT NULL,
  created_at TIMESTAMP NOT NULL DEFAULT now(),
  updated_at TIMESTAMP NOT NULL DEFAULT now(),
  FOREIGN KEY (order_id) REFERENCES orders (id) ON DELETE CASCADE,
  FOREIGN KEY (product_id) REFERENCES products (id) ON DELETE SET NULL
);

INSERT INTO
  product_categories(name, tax)
VALUES
  ('Lanches', 1.5),
  ('Sobremesas', 2),
  ('Bebidas', 4);

INSERT INTO
  products(name, price, category_id)
VALUES
  ('Coxinha', 5, 1),
  ('Pastel', 7, 1),
  ('Croissant', 10, 1),
  ('Brigadeiro', 2, 2),
  ('Beijinho', 2.5, 2),
  ('Bolo', 30, 2),
  ('Refrigerante', 10, 3),
  ('Água', 2, 3),
  ('Suco', 7.5, 3);