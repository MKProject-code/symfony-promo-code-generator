# Description

This is a simple promotional code generator written in PHP - Symfony framework.
You can generate code from WEB page or console command.
The generated codes save to database.

# Run server

`symfony server:start`

# Test

#### Windows
`php bin\phpunit`

#### Linux
`./bin/phpunit`

# Promo codes generator

### From browser

`https://127.0.0.1:8000/code`

### From console

#### Windows
`php bin\console generate-promo-codes [-a|--alphanumeric] [-h|--help] [-q|--quiet] [-v|vv|vvv|--verbose] [-V|--version] [--ansi] [--no-ansi] [-n|--no-interaction] [-e|--env ENV] [--no-debug] [--] <command> <length> <amount>`

#### Linux
`./bin/console generate-promo-codes [-a|--alphanumeric] [-h|--help] [-q|--quiet] [-v|vv|vvv|--verbose] [-V|--version] [--ansi] [--no-ansi] [-n|--no-interaction] [-e|--env ENV] [--no-debug] [--] <command> <length> <amount>`

```
Description:
  Generate promo codes and save them to file

Usage:
  generate-promo-codes [options] [--] <length> <amount>

Arguments:
  length                length of one code
  amount                amount of code to generate

Options:
  -a, --alphanumeric    Generate alphanumeric codes
  -h, --help            Display this help message
  -q, --quiet           Do not output any message
  -V, --version         Display this application version
      --ansi            Force ANSI output
      --no-ansi         Disable ANSI output
  -n, --no-interaction  Do not ask any interactive question
  -e, --env=ENV         The Environment name. [default: "dev"]
      --no-debug        Switches off debug mode.
  -v|vv|vvv, --verbose  Increase the verbosity of messages: 1 for normal output, 2 for more verbose output and 3 for debug
```
