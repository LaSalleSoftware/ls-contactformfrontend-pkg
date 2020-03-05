# LaSalle Software's Contact Form Front-end Package

<p align="center">
<a href="https://packagist.org/packages/lasallesoftware/lsv2-contactformfrontend-pkg"><img src="https://poser.pugx.org/lasallesoftware/lsv2-contactformfrontend-pkg/v/stable.svg" alt="Latest Stable Version"></a>
<a href="https://packagist.org/packages/lasallesoftware/lsv2-contactformfrontend-pkg"><img src="https://poser.pugx.org/lasallesoftware/lsv2-contactformfrontend-pkg/license.svg" alt="License"></a>
<a href="https://laravel.com/"><img src="https://img.shields.io/badge/Laravel-v6-brightgreen.svg?style=flat-square" alt="Laravel v6.x"></a> 
</p>

Contact Form Front-end package for my LaSalle Software Version 2.

## Shpiel

The contact form packages are made specifically for my LaSalle Software.

This front-end package is the bulk of the functionality: the forms and the form processing. 

Originally, I created one contact form package. But, I broke the package into a front-end and a back-end package once I decided that I would integrate Nova. So the database and Nova stuff is in the back-end. 

The form processing sends an email to the recipients, and inserts the form's input data into the database. Both are done via the Laravel job queue, so you have to set the queue up as usual -- and the email also -- for Laravel. 

The front-end sends the back-end the "post" data, which the back-end then uses to insert into the "contact_form" database table. This table has a corresponding Nova resource (in the contact form's back-end package) for the convenience of seeing the incoming emails directly in the admin. 

## Installation

Both my apps include these packages in their composer files. 

You need to set up your job queue and email up per Laravel's instructions.

There are config files, which are in the front-end app already for your convenience. Please customize the settings.

If you do not want to use the provided views, then do customize for your needs. 

## Security

If you discover any security related issues, please email Bob Bloom at "bob dot bloom at lasallesoftware dot ca" instead of using the issue tracker.

## Caveat

You will need to sign up for a third party transactional email service, which may or may not cost money. 

## License

LaSalle Software is open-sourced software licensed under the [MIT license](https://opensource.org/licenses/MIT).

As reference, there is a wonderful blog post called [The MIT License, Line by Line -- 171 words every programmer should understand](https://writing.kemitchell.com/2016/09/21/MIT-License-Line-by-Line.html).

Please note:
>THE SOFTWARE IS PROVIDED "AS IS", WITHOUT WARRANTY OF ANY KIND, EXPRESS OR IMPLIED, INCLUDING BUT NOT LIMITED TO THE WARRANTIES OF MERCHANTABILITY, FITNESS FOR A PARTICULAR PURPOSE AND NONINFRINGEMENT. IN NO EVENT SHALL THE AUTHORS OR COPYRIGHT HOLDERS BE LIABLE FOR ANY CLAIM, DAMAGES OR OTHER LIABILITY, WHETHER IN AN ACTION OF CONTRACT, TORT OR OTHERWISE, ARISING FROM, OUT OF OR IN CONNECTION WITH THE SOFTWARE OR THE USE OR OTHER DEALINGS IN THE SOFTWARE.
>
## Links

* [Change Log](CHANGELOG.md)

