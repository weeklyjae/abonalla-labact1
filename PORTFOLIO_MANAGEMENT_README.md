# Portfolio Images Management

This document explains how to view and manage images in your coding and video editing portfolios.

## Overview

Your Laravel application now includes a dedicated admin interface for managing portfolio images. You can:

- **View all images** in your coding and video editing portfolios
- **Delete unwanted images** with a confirmation modal
- **See image details** including filename, size, and full-size preview
- **Navigate between portfolios** using tabs

## Accessing Portfolio Management

### Method 1: Direct Navigation
1. Go to `/admin/portfolios` in your browser
2. You must be logged in as an admin user

### Method 2: Through Admin Navigation
1. Go to any admin page (e.g., `/admin/gallery`)
2. Look for the "Portfolios" button in the admin navigation
3. Click on it to access portfolio management

### Method 3: From Gallery Admin
1. Go to `/admin/gallery`
2. Look for the "Manage Portfolios" button in the "Other Galleries" section
3. Click on it to access portfolio management

## Features

### Portfolio Tabs
- **Coding Portfolio**: Shows all images uploaded to the coding portfolio
- **Video Editing Portfolio**: Shows all images uploaded to the video editing portfolio
- Each tab displays the count of images in that portfolio

### Image Management
For each image, you can see:
- **Thumbnail preview** (hover to see delete button)
- **Image name** (formatted from filename)
- **Original filename**
- **File size** in bytes
- **Full-size view** link (opens in new tab)

### Delete Functionality
1. **Hover over an image** to reveal the delete button
2. **Click "Delete Image"** to open confirmation modal
3. **Confirm deletion** in the modal
4. **Image is permanently removed** from both storage and portfolio

## File Structure

Images are stored in the following locations:
- **Coding Portfolio**: `storage/app/public/gallery/coding/`
- **Video Editing Portfolio**: `storage/app/public/gallery/editing/`

## Uploading New Images

To add new images to your portfolios:

1. Go to `/admin/gallery`
2. Select the appropriate portfolio from the dropdown:
   - "Coding Portfolio" for coding projects
   - "Video Editing Portfolio" for video editing work
3. Choose your image files (JPG, PNG, GIF up to 2MB each)
4. Click "Upload Photos"

## Security Features

- **Authentication required**: Only logged-in admin users can access
- **CSRF protection**: All forms include CSRF tokens
- **Confirmation modal**: Prevents accidental deletions
- **File validation**: Only image files are accepted

## Troubleshooting

### Images Not Showing
- Check if images exist in the correct storage folders
- Verify file permissions on storage directories
- Ensure images are valid image files (JPG, PNG, GIF)

### Delete Not Working
- Check browser console for JavaScript errors
- Verify you're logged in as an admin user
- Check if the image file exists in storage

### Upload Issues
- Ensure file size is under 2MB
- Check file format (JPG, PNG, GIF only)
- Verify storage disk permissions

## Technical Details

### Routes
- `GET /admin/portfolios` - Portfolio management page
- `DELETE /admin/gallery/{folder}/{filename}` - Delete image

### Controller
- `GalleryController@portfolios()` - Shows portfolio management view
- `GalleryController@destroy()` - Handles image deletion

### Views
- `resources/views/admin/portfolios.blade.php` - Main portfolio management interface

## Customization

### Adding New Portfolio Types
To add new portfolio types:

1. Update the `portfolios()` method in `GalleryController`
2. Add new tabs in the portfolios view
3. Update the admin navigation if needed

### Modifying Image Display
The image grid uses Tailwind CSS classes and can be customized by:
- Changing grid layout (`grid-cols-1 md:grid-cols-2 lg:grid-cols-3`)
- Modifying image dimensions (`h-48 w-full`)
- Adjusting hover effects and transitions

## Support

If you encounter issues:
1. Check the Laravel logs in `storage/logs/laravel.log`
2. Verify all routes are properly registered
3. Ensure admin middleware is working correctly
4. Check file permissions on storage directories
