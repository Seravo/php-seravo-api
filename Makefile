APT_PROXY ?=
DOCKER ?= docker
IMAGE = ghcr.io/seravo/php-api:latest

all:

build:
	$(DOCKER) build \
		--build-arg APT_PROXY="$(APT_PROXY)" \
		--tag "$(IMAGE)" \
		.

run:
	$(DOCKER) run --rm -it -v "$(shell pwd)/.env:/.env" "$(IMAGE)" bash
