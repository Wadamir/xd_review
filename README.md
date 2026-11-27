# XD Reviews for ocStore

XD Reviews is a storefront review module for ocStore 3.0.3.9. It displays
approved reviews in a responsive grid or Swiper carousel and provides
administrative review moderation tools.

Review submission remains handled by the standard OpenCart/ocStore product
review form. This module is responsible for displaying approved reviews only.

## Features

- Responsive review grid:
  - 12 columns on extra-small screens
  - 12 columns on small screens
  - 6 columns on medium screens
  - 4 columns on large screens
- Responsive Swiper carousel:
  - 1 review below 768 px
  - 2 reviews from 768 px
  - 3 reviews from 992 px
- Configurable panel title and reviews per page
- Fixed-height review cards
- Author avatar, fallback initials, and star ratings
- Product preview images with the store logo used as a fallback
- Links to the reviewed product
- Administrative approval, rejection, filtering, and deletion
- Russian and English language files

## Installation

1. Upload the `admin`, `catalog`, and `image` module files to the ocStore
   document root.
2. Open the ocStore administration panel.
3. Go to **Extensions > Extensions > Modules**.
4. Install or enable **XD Reviews**.
5. Grant the administrator group access and modify permissions for
   `extension/module/xd_review`.

## Configuration

Open **Extensions > Modules > XD Reviews**.

The settings page contains:

- **Status**: enables or disables the storefront module.
- **Publish reviews after approval**: controls review moderation.
- **Allow guest reviews**: controls the standard OpenCart/ocStore submission
  form settings.
- **Minimum review length**: sets the minimum text length for submitted
  reviews.
- **Panel title**: replaces the automatically generated title.
- **Reviews per page**: sets the grid page size.
- **Display as carousel**: switches the storefront output to Swiper.

Add **XD Reviews** to the required storefront layout under
**Design > Layouts**. The module reads the current `product_id` on product
pages and displays reviews for that product. On layout pages without a
`product_id`, it displays all approved reviews.

## Review management

Open the **Reviews** tab in the module settings to filter and moderate reviews.
Approved reviews use `status = 1`; reviews awaiting approval use `status = 0`.

## Files

- `admin/controller/extension/module/xd_review.php`
- `admin/view/template/extension/module/xd_review.twig`
- `catalog/controller/extension/module/xd_review.php`
- `catalog/model/extension/module/xd_review.php`
- `catalog/view/theme/default/template/extension/module/xd_review.twig`
- `catalog/view/theme/default/template/extension/module/xd_review_list.twig`
- `catalog/view/theme/default/stylesheet/xd_review.css`

The module stylesheet is separate from the theme's original
`catalog/view/theme/default/stylesheet/stylesheet.css`.
