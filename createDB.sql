/*CREATE TABLE
caracteristics (
product_id int NOT NULL,
category_id int NOT NULL,
CONSTRAINT PK_products_categories PRIMARY KEY (product_id, category_id)
);*/
CREATE TABLE
    categories (
        id int PRIMARY KEY AUTO_INCREMENT,
        label VARCHAR(15) NOT NULL UNIQUE,
        CONSTRAINT labelMinLength CHECK (LENGTH (label) >= 3)
    );

CREATE TABLE
    products (
        id int PRIMARY KEY AUTO_INCREMENT,
        ref VARCHAR(5) NOT NULL UNIQUE,
        name VARCHAR(50) NOT NULL,
        price DECIMAL(10, 2) NOT NULL,
        description TEXT,
        category_id int NOT NULL,
        CONSTRAINT FK_products_categories FOREIGN KEY (category_id) REFERENCES categories (id),
        CONSTRAINT pricePositive CHECK (price >= 0),
        CONSTRAINT nameMinLength CHECK (LENGTH (name) >= 3),
        CONSTRAINT refMaxLength CHECK (LENGTH (ref) < 6)
    );

INSERT INTO
    categories (label)
VALUES
    ("kitchen"),
    ("living room"),
    ("bedroom"),
    ("bathroom");

INSERT INTO
    products (ref, name, price, description, category_id)
VALUES
    (
        'ABC25',
        'chair',
        45.99,
        'A beautiful yellow chair',
        2
    ),
    (
        'DEF36',
        'table',
        99.99,
        'A sturdy wooden table',
        2
    ),
    (
        'GHI47',
        'lamp',
        29.99,
        'An elegant standing lamp',
        3
    ),
    ('JKL58', 'sofa', 199.99, 'A cozy fabric sofa', 2),
    (
        'MNO69',
        'mirror',
        59.99,
        'A decorative wall mirror',
        4
    ),
    ('PQR70', 'clock', 24.99, 'A modern wall clock', 3),
    (
        'STU81',
        'bookshelf',
        79.99,
        'A sturdy wooden bookshelf',
        2
    ),
    ('VWX92', 'rug', 39.99, 'A soft and fluffy rug', 1),
    (
        'YZA03',
        'vase',
        14.99,
        'A stylish ceramic vase',
        4
    ),
    (
        'BCD14',
        'desk',
        129.99,
        'A sleek and modern desk',
        2
    ),
    (
        'EFG25',
        'bed',
        299.99,
        'A comfortable queen-size bed',
        3
    ),
    (
        'HIJ36',
        'side table',
        49.99,
        'A minimalist side table',
        2
    ),
    (
        'KLM47',
        'painting',
        89.99,
        'An abstract painting',
        4
    ),
    (
        'NOP58',
        'shelves',
        69.99,
        'Adjustable shelving unit',
        2
    ),
    (
        'QRS69',
        'lampshade',
        19.99,
        'A stylish lampshade',
        3
    ),
    (
        'STU70',
        'curtains',
        34.99,
        'Sheer curtains for privacy',
        2
    ),
    (
        'VWX81',
        'throw pillow',
        9.99,
        'Decorative throw pillow',
        1
    ),
    (
        'YZA92',
        'coffee table',
        79.99,
        'A modern glass coffee table',
        2
    ),
    (
        'BCD03',
        'tea kettle',
        29.99,
        'Stainless steel tea kettle',
        1
    ),
    (
        'EFG14',
        'nightstand',
        59.99,
        'A bedside nightstand',
        3
    ),
    (
        'HIJ25',
        'cutlery set',
        39.99,
        'Stainless steel cutlery set',
        1
    ),
    (
        'KLM36',
        'wall art',
        69.99,
        'Abstract wall art',
        4
    ),
    (
        'NOP47',
        'bar stool',
        49.99,
        'Adjustable bar stool',
        2
    ),
    (
        'QRS58',
        'floor lamp',
        79.99,
        'A modern floor lamp',
        3
    ),
    (
        'STU69',
        'shower curtain',
        24.99,
        'Waterproof shower curtain',
        4
    ),
    (
        'VWX70',
        'dining table',
        199.99,
        'A wooden dining table',
        2
    ),
    (
        'YZA81',
        'picture frame',
        14.99,
        'Wooden picture frame',
        3
    ),
    (
        'BCD92',
        'candle holder',
        19.99,
        'Metal candle holder',
        4
    ),
    (
        'EFG03',
        'knife set',
        34.99,
        'Professional knife set',
        1
    ),
    (
        'HIJ14',
        'ottoman',
        69.99,
        'A comfortable fabric ottoman',
        2
    ),
    ('KLM25', 'toaster', 39.99, '4-slice toaster', 1),
    (
        'NOP36',
        'accent chair',
        149.99,
        'A stylish accent chair',
        2
    ),
    (
        'QRS47',
        'wall clock',
        29.99,
        'Modern wall clock',
        3
    ),
    (
        'STU58',
        'throw blanket',
        19.99,
        'Cozy throw blanket',
        1
    ),
    (
        'VWX69',
        'soap dispenser',
        12.99,
        'Stylish soap dispenser',
        4
    ),
    (
        'YZA70',
        'couch cover',
        49.99,
        'Stretchable couch cover',
        2
    ),
    (
        'BCD81',
        'desk lamp',
        24.99,
        'Adjustable desk lamp',
        3
    ),
    (
        'EFG92',
        'shoe rack',
        29.99,
        'Wooden shoe rack',
        4
    ),
    (
        'HIJ03',
        'salad bowl',
        19.99,
        'Large salad serving bowl',
        1
    ),
    (
        'KLM14',
        'wine glasses',
        29.99,
        'Set of 4 wine glasses',
        3
    ),
    (
        'NOP25',
        'comforter set',
        79.99,
        'Luxurious comforter set',
        2
    ),
    (
        'QRS36',
        'throw rug',
        29.99,
        'Decorative throw rug',
        1
    ),
    (
        'STU47',
        'kitchen cart',
        89.99,
        'Rolling kitchen cart',
        2
    ),
    (
        'VWX58',
        'shower caddy',
        34.99,
        'Hanging shower caddy',
        4
    ),
    (
        'YZA69',
        'coasters',
        9.99,
        'Set of 6 cork coasters',
        3
    );