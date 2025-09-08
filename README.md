# 🖼️ Laravel 11 Image Resizer

A simple **Laravel 11 project** for uploading, cropping, and resizing images.  
This project uses **Cropper.js** to provide a smooth user interface for adjusting image size (height & width) before saving.  

---

## 🚀 Features
- Upload images in **JPEG** and **PNG** formats (up to 5MB).
- Interactive cropping and resizing using **Cropper.js**.
- Set custom **height** and **width** before saving.
- Preview cropped image before download/save.
- Clean and responsive UI.


## 🛠️ Requirements
- **PHP >= 8.2**
- **Laravel 11**
- **Composer**
- **Node.js & NPM**
- Supported Browsers: Chrome, Firefox, Edge

---

## ⚙️ Installation

1. Clone the repository:
   ```bash
   git clone https://github.com/phpwhizdeveloper002/Resize-image-project.git
   cd Resize-image-project
````

2. Configure environment:

   ```bash
   cp .env.example .env
   php artisan key:generate
   ```

3. Install Composer:

   ```bash
   composer install
   ```

4. Serve the application:

   ```bash
   php artisan serve
   ```

5. Visit the app in your browser:

   ```
   http://localhost:8000
   ```

---

## 📂 Project Structure

```
├── app/
├── public/
│   ├── uploads/        # Uploaded & resized images
│   ├── css/            # Custom styles
│   ├── js/             # Cropper.js integration
├── resources/views/    # Blade templates
│   └── welcome.blade.php
├── routes/web.php      # Routes for image handling
```

---

## 🔧 Usage

1. Click **Browse Files** to upload an image.
2. Adjust cropping area and set desired **width** & **height**.
3. Click **Save** to resize and download/store the image.

---

## 📦 Packages & Libraries

* [Laravel 11](https://laravel.com/)
* [Cropper.js](https://github.com/fengyuanchen/cropperjs)
* [Bootstrap 5](https://getbootstrap.com/) (for UI)
