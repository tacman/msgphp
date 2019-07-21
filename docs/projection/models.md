# Projections

Projection models are "[vanilla] PHP objects". Its purpose is to represent a stored document.

The document is usually a transformation from a domain object (e.g. an entity) and therefor projections should be
considered read-only and disposable, given they can be re-created / synchronized at any point in time from a source of
truth (the repository).

A practical use case for projections are APIs, where each API resource is a so called projection, corresponding to its
domain entity. It enables decoupling and thus optimized API responses.

[vanilla]: https://en.wikipedia.org/wiki/Plain_vanilla
