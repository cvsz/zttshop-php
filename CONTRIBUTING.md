# Contributing

## Scope

This repository accepts improvements to:

- API resource coverage
- request helpers
- tests
- documentation

## Local Setup

```bash
composer install
composer test
```

Some tests rely on environment variables for live TikTok Shop access.

## Branching

- Create a focused branch for each change
- Keep commits small and descriptive
- Include tests for behavioral changes

## Documentation Expectations

If you add or change a public resource method:

- update `README.md`
- update `PROJECT_DOCS.md`
- add or adjust a test

If you add a repository workflow or GitHub-facing file:

- update the relevant GitHub template or policy document

## Pull Request Checklist

- Tests pass locally
- Documentation is current
- New public methods are documented
- Breaking changes are called out clearly
