FROM aleksajo/php-cli:latest as build

RUN apt-get update -y && apt-get install -y --no-install-recommends \
libz-dev \
cmake \
unzip && \
cd /tmp/ && \
wget https://github.com/protocolbuffers/protobuf/releases/download/v22.2/protoc-22.2-linux-x86_64.zip && \
unzip protoc-22.2-linux-x86_64.zip && \
mv bin/protoc /usr/local/bin/protoc && \
git clone -b v1.53.0 https://github.com/grpc/grpc && \
cd grpc && \
git submodule update --init && \
mkdir -p cmake/build && \
cd cmake/build && \
cmake ../.. && \
make protoc grpc_php_plugin

FROM aleksajo/php-cli:latest

COPY --from=build /tmp/grpc/cmake/build/third_party/protobuf/protoc /usr/local/bin/protoc
COPY --from=build /tmp/grpc/cmake/build/grpc_php_plugin /usr/local/bin/grpc_php_plugin

RUN apt-get update -y && apt-get install -y --no-install-recommends \
libz-dev && \
pecl install grpc && docker-php-ext-enable grpc && \
pecl install protobuf && docker-php-ext-enable protobuf && \
docker-php-source delete && \
apt-get clean && \
rm -rf /var/lib/apt/lists/* && \
rm -rf /tmp/*