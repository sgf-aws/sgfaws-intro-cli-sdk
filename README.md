# Intro to AWS CLI and AWS SDK

Sample commands and code from my Intro to AWS CLI and AWS SDK presentation to the Springfield AWS User Group.

* Meetup Event (https://www.meetup.com/sgfaws/events/278003050/)
* YouTube Video (https://youtu.be/oUWBLzdempk)

## AWS CLI Commands and Code

### Configure Named Profile

```
# Does the Named Profile already exist?
aws configure list --profile demo

# Configure the Named Profile
aws configure --profile demo

# Review the Named Profile
aws configure list --profile demo

# Set the Named Profile as the current profile
export AWS_PROFILE=demo

# Review the Named Profile
aws configure list

# Notice the AWS client used the Named Profile environment variable.
# We did NOT have to specify the profile parameter!
```

### S3 Examples

```
# Make Bucket
aws s3 mb s3://example-bucket-name

# List Bucket Contents (empty result)
aws s3 ls s3://example-bucket-name

# Display File Contents
cat hello.txt

# Copy File to Bucket
aws s3 cp hello.txt s3://example-bucket-name/hello.txt

# List Bucket Contents
aws s3 ls s3://example-bucket-name

# Copy File from Bucket to new local file
aws s3 cp s3://example-bucket-name/hello.txt local.txt

# Display File Contents (same as original file above)
cat local.txt

# Remove File from Bucket
aws s3 rm s3://example-bucket-name/hello.txt

# Remove Bucket
aws s3 rb s3://example-bucket-name
```

### EC2 Examples

```
# Describe EC2 Instances
aws ec2 describe-instances | jq
aws ec2 describe-instances | jq '.Reservations[].Instances[] | {InstanceId, InstanceType, AvailabilityZone: .Placement.AvailabilityZone}'

# Describe Status of EC2 Instances (only 1 of 2 instances were running)
aws ec2 describe-instance-status | jq
aws ec2 describe-instance-status | jq '.InstanceStatuses[] | {InstanceId, InstanceState: .InstanceState.Name}'

# Start EC2 Instance (start the instance that was not running)
aws ec2 start-instances --instance-ids i-0a1b2c3d4f5g67890
```

### CloudFormation Examples

The `cli/s3.yaml` file in this repo contains the CloudFormation template shown during the demo.

```
# Create CloudFormation Template
vi s3.yaml

# Create CloudFormation Stack
aws cloudformation create-stack --stack-name sgfaws-demo-cli --template-body file://./s3.yaml

# Describe CloudFormation Stack
aws cloudformation describe-stacks --stack-name sgfaws-demo-cli | jq

# List Bucket Contents (make sure bucket is empty)
aws s3 ls s3://sgfaws-demo-cli-cf

# Delete CloudFormation Stack
aws cloudformation delete-stack --stack-name sgfaws-demo-cli

# Describe CloudFormation Stack (make sure stack was deleted)
aws cloudformation describe-stacks --stack-name sgfaws-demo-cli | jq
```

### AWS CLI Resources

* AWS Command Line Interface - Official Downloads and Reference (https://aws.amazon.com/cli/)
* AWS CLI Named Profile Reference (https://docs.aws.amazon.com/cli/latest/userguide/cli-configure-profiles.html)
* JQ (JSON Query) - Command Line JSON Processor (https://stedolan.github.io/jq/)
* Amazon S3 Tools: S3cmd Sync - More Powerful Sync Tools for CLI (https://s3tools.org/s3cmd-sync)
* Commands and Code Samples (https://github.com/sgf-aws/sgfaws-intro-cli-sdk)

## AWS SDK Commands and Code

The `sdk/index.php` and `sdk/s3gz.php` files in this repo contains the PHP scripts shown during the demo.

```
# Install AWS SDK for PHP using the Composer Package Manager
composer require aws/aws-sdk-php

# Create PHP Script
vi index.php

# Run PHP Script
php index.php
```

### AWS SDK Resources

* AWS SDK and Tools - Official Downloads and Reference (https://aws.amazon.com/getting-started/tools-sdks/)
* AWS SDK for PHP - Version 3 - Official Reference (https://docs.aws.amazon.com/sdk-for-php/v3/developer-guide/)
* Amazon SDK for PHP: putObject() Reference (https://docs.aws.amazon.com/aws-sdk-php/v3/api/api-s3-2006-03-01.html#putobject)
* Commands and Code Samples (https://github.com/sgf-aws/sgfaws-intro-cli-sdk)
