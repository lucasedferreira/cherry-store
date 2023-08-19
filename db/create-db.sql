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
  FOREIGN KEY (category_id)
    REFERENCES product_categories (id)
);