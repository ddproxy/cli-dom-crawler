# cli-dom-crawler
PHP Dom Crawler for commandline

## Install
Clone the repository and install dependencies with composer.

`composer install`

## Commands
Commands can be run by command line with php.
`php ./src/cli-dom-crawler.php <command>`

### List Nodes
List nodes and their attributes from a website.

`php ./src/cli-dom-crawler.php <url> <node> <attributes>`

Example:
`php ./src/cli-dom-crawler.php https://www.google.com a href`

```
+---------------------+----------------------------------------------------------------------------------------------+
| text                | href                                                                                         |
+---------------------+----------------------------------------------------------------------------------------------+
| Images              | https://www.google.com/imghp?hl=en&tab=wi                                                    |
| Maps                | https://maps.google.com/maps?hl=en&tab=wl                                                    |
| Play                | https://play.google.com/?hl=en&tab=w8                                                        |
| YouTube             | https://www.youtube.com/?tab=w1                                                              |
| News                | https://news.google.com/nwshp?hl=en&tab=wn                                                   |
| Gmail               | https://mail.google.com/mail/?tab=wm                                                         |
| Drive               | https://drive.google.com/?tab=wo                                                             |
| More »              | https://www.google.com/intl/en/options/                                                      |
| Web History         | http://www.google.com/history/optout?hl=en                                                   |
| Settings            | /preferences?hl=en                                                                           |
| Sign in             | https://accounts.google.com/ServiceLogin?hl=en&passive=true&continue=https://www.google.com/ |
| Advanced search     | /advanced_search?hl=en&authuser=0                                                            |
| Language tools      | /language_tools?hl=en&authuser=0                                                             |
| AdvertisingPrograms | /intl/en/ads/                                                                                |
| Business Solutions  | /services/                                                                                   |
| +Google             | https://plus.google.com/116899029375914044550                                                |
| About Google        | /intl/en/about.html                                                                          |
| Privacy             | /intl/en/policies/privacy/                                                                   |
| Terms               | /intl/en/policies/terms/                                                                     |
+---------------------+----------------------------------------------------------------------------------------------+
```