ROOT_DIR := ${CURDIR}
PATH_SRC := $(ROOT_DIR)/builder

args = $(filter-out $@,$(MAKECMDGOALS))
firstArgs = $(word 2,$(MAKECMDGOALS))
secondArgs = $(word 3,$(MAKECMDGOALS))

# @echo ./prog $(call args) - печать команды
%:
	@:

### Docker command
delete_container:
	docker rm -vf $(call firstArgs)

delete_image:
	docker rmi -f $(call firstArgs)

exec:
	docker exec -it $(call firstArgs) sh

connect:
	docker exec -u $$(id -u):$$(id -g) -it $(call firstArgs) sh

debug:
	cd $(PATH_SRC)/$(call firstArgs) && DOCKER_OPTIONS='-it' ./start.sh

debug_ep:
	cd $(PATH_SRC)/$(call firstArgs) && DOCKER_OPTIONS='-it --entrypoint=/bin/sh' DOCKER_COMMAND=' ' ./start.sh

start:
	cd $(PATH_SRC)/$(call firstArgs) && DOCKER_OPTIONS='-d' ./start.sh

build:
	docker build --rm --no-cache=true -t php .

nuclear:
	docker rm -vf $$(docker ps -a -q) 2>/dev/null || echo "No more containers to remove."
	docker rmi -f $$(docker images -a -q) 2>/dev/null || echo "No more images to remove."

clear_unused:
	docker ps -q -f status=exited | xargs --no-run-if-empty docker rm
	docker images -q -f dangling=true | xargs --no-run-if-empty docker rmi