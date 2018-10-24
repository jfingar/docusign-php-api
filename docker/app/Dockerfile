FROM centos:latest
RUN rpm -Uvh https://dl.fedoraproject.org/pub/epel/epel-release-latest-7.noarch.rpm && \
    rpm -Uvh https://mirror.webtatic.com/yum/el7/webtatic-release.rpm && \
    yum update -y
RUN yum -y install sendmail nano php70w php70w-cli php70w-common php70w-odbc php70w-ldap php70w-mysql php70w-pdo php70w-pear php70w-soap php70w-xml php70w-xmlrpc php70w-mbstring php70w-mcrypt httpd
RUN yum clean all
EXPOSE 80 443
WORKDIR /var/www/html
CMD ["-D", "FOREGROUND"]
ENTRYPOINT ["/usr/sbin/httpd"]
COPY files/ /
RUN rpm -ivh --nodeps /ibm-iaccess-1.1.0.8-1.0.x86_64.rpm && \
    ln -s /lib64/libodbcinst.so.2 /lib64/libodbcinst.so.1