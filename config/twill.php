<?php

return [
     'media_library' => [
        'disk' => 'twill_media_library',
        'endpoint_type' => env('MEDIA_LIBRARY_ENDPOINT_TYPE', 'local'),
        'S3_KEY'=> env('CLOUDFLARE_R2_ACCESS_KEY_ID'),
        'S3_SECRET' => env('CLOUDFLARE_R2_SECRET_ACCESS_KEY'),
        'S3_BUCKET'=> 'site-assets',
        'S3_ENDPOINT'=> env('CLOUDFLARE_R2_ENDPOINT'),
        's3_browser_uploads' => env('MEDIA_LIBRARY_S3_BROWSER_UPLOADS', false),
        'cascade_delete' => env('MEDIA_LIBRARY_CASCADE_DELETE', false),
        'local_path' => env('MEDIA_LIBRARY_LOCAL_PATH', 'uploads'),
        'image_service' => env('MEDIA_LIBRARY_IMAGE_SERVICE', 'A17\Twill\Services\MediaLibrary\Glide'),
        'acl' => env('MEDIA_LIBRARY_ACL', 'public-read'),
        'filesize_limit' => env('MEDIA_LIBRARY_FILESIZE_LIMIT', 100),
        'allowed_extensions' => ['svg', 'jpg', 'gif', 'png', 'jpeg', 'webp'],
        'init_alt_text_from_filename' => true,
        'prefix_uuid_with_local_path' => config('twill.file_library.prefix_uuid_with_local_path', false),
        'translated_form_fields' => false,
        'show_file_name' => false,
        'media_caption_use_wysiwyg' => false,
        'media_caption_wysiwyg_options' => [
            'modules' => [
                'toolbar' => [
                    'bold',
                    'italic',
                ],
            ],
        ],
    ]
];
