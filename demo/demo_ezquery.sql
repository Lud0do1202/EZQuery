CREATE TABLE `users` (
  `id` int(11) NOT NULL,
  `lastname` varchar(128) NOT NULL,
  `firstname` varchar(128) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

ALTER TABLE `users`
  ADD PRIMARY KEY (`id`);
COMMIT;

