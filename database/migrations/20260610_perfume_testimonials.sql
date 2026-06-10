-- Convert existing testimonial records to perfume-focused customer experiences.
-- The testimonials table already includes all fields required for CRUD and ordering.

UPDATE `testimonials`
SET
  `author_detail` = 'Wedding Day Fragrance',
  `quote` = 'Maison Doree helped me find a luminous floral perfume for my wedding day. It lasted beautifully from the ceremony through the final dance and now brings the whole day back with one spray.',
  `rating` = 5,
  `avatar_alt` = 'Portrait of Catherine W.',
  `sort_order` = 1
WHERE `id` = 1;

UPDATE `testimonials`
SET
  `author_detail` = 'Personal Scent Consultation',
  `quote` = 'The fragrance consultation was thoughtful and effortless. The team listened to the notes I enjoy and introduced me to a warm amber scent that feels completely personal.',
  `rating` = 5,
  `avatar_alt` = 'Portrait of Michael T.',
  `sort_order` = 2
WHERE `id` = 2;

UPDATE `testimonials`
SET
  `author_detail` = 'Heritage Fragrance Collection',
  `quote` = 'I discovered a refined perfume with soft woods and iris that has become my everyday signature. The quality is exceptional, and I receive compliments whenever I wear it.',
  `rating` = 5,
  `avatar_alt` = 'Portrait of Eleanor M.',
  `sort_order` = 3
WHERE `id` = 3;
