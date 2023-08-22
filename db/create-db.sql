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
  ('Categoria 1', 1.5),
  ('Categoria 2', 2),
  ('Categoria 4', 4);

INSERT INTO
  products(name, price, category_id)
VALUES
  ('Produto 1', 20, 1),
  ('Produto 2', 15, 1),
  ('Produto 3', 30, 1),
  ('Produto 4', 19.99, 2),
  ('Produto 5', 11, 2),
  ('Produto 6', 5, 2),
  ('Produto 7', 50, 3),
  ('Produto 8', 100, 3);