# Captcha for Notadd

## Preview
![Preview](http://i.imgur.com/HYtr744.png)

## Example Usage
```php

    // [your site path]/Http/routes.php

    Route::any('captcha-test', function()
    {
        if (Request::getMethod() == 'POST')
        {
            $rules = ['captcha' => 'required|captcha'];
            $validator = Validator::make(Input::all(), $rules);
            if ($validator->fails())
            {
                echo '<p style="color: #ff0000;">Incorrect!</p>';
            }
            else
            {
                echo '<p style="color: #00ff30;">Matched :)</p>';
            }
        }
    
        $form = '<form method="post" action="captcha-test">';
        $form .= '<input type="hidden" name="_token" value="' . csrf_token() . '">';
        $form .= '<p>' . captcha_img() . '</p>';
        $form .= '<p><input type="text" name="captcha"></p>';
        $form .= '<p><button type="submit" name="check">Check</button></p>';
        $form .= '</form>';
        return $form;
    });
```

# Return Image
```php
captcha();
```
or
```php
Captcha::create();
```


# Return URL
```php
captcha_src();
```
or
```
Captcha::src();
```

# Return HTML
```php
captcha_img();
```
or
```php
Captcha::img();
```

# To use different configurations
```php
captcha_img('flat');

Captcha::img('inverse');
```
etc.

Based on [L5 Captcha on Github](https://github.com/mewebstudio/captcha)

^_^

## Links
* [Intervention Image](https://github.com/Intervention/image)
* [License](http://www.opensource.org/licenses/mit-license.php)
* [Notadd website](http://notadd.com)
